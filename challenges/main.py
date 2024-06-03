import json
import pika
import docker
import threading
import time

client = docker.from_env()
stop_event = threading.Event()
container_threads = {}


def callback(ch, method, properties, body):
    message = json.loads(body)
    if message and message['challengeId'] and message['timeout']:
        challenge_id = int(message['challengeId'])
        timeout = int(message['timeout'])

        print(f"Received challengeId: {challenge_id} with timeout {timeout}s")
        start_challenge(challenge_id, timeout)


def stop_container_after_timeout(container, timeout, reset_event):
    while not stop_event.is_set():
        if reset_event.wait(timeout):
            reset_event.clear()
        else:
            break

    if not stop_event.is_set():
        try:
            container.stop()
            container.remove()
            print(f"Container {container.id} stopped and removed after {timeout} seconds.")
        except Exception as e:
            print(f"Error stopping or removing container {container.id}: {e}")


def container_exists(container_image_text):
    containers = client.containers.list(all=True)
    for container in containers:
        image_tags = container.image.tags
        if container_image_text in image_tags:
            return container
    return None


def start_challenge(challenge_id, timeout):
    container_image_text = f"challenge_{challenge_id}:latest"
    existing_container = container_exists(container_image_text)
    if not existing_container:
        try:
            container = client.containers.run(
                container_image_text,
                detach=True,
                ports={'80/tcp': 8001}
            )

            reset_event = threading.Event()
            thread = threading.Thread(target=stop_container_after_timeout, args=(container, timeout, reset_event))
            thread.start()
            container_threads[container.id] = (container, thread, reset_event)

            print(f"Challenge {challenge_id} started.")

        except Exception as e:
            print('Error: ', e)
    else:
        # Reset timeout for the existing container
        container_id = existing_container.id
        if container_id in container_threads:
            container, thread, reset_event = container_threads[container_id]
            reset_event.set()
            print(f"Timeout reset for challenge {challenge_id}.")


def main():
    connection = pika.BlockingConnection(pika.ConnectionParameters('localhost'))
    channel = connection.channel()

    channel.queue_declare(queue='docker', durable=True)

    channel.basic_consume(queue='docker',
                          on_message_callback=callback,
                          auto_ack=True)

    print('Waiting for messages. To exit press CTRL+C')
    try:
        channel.start_consuming()
    except KeyboardInterrupt:
        print('Exiting...')
        stop_event.set()
        containers = client.containers.list(all=True)
        for container in containers:
            try:
                container.stop()
                container.remove()
            except Exception as e:
                print(e)
        print('All containers stopped and removed')


if __name__ == "__main__":
    main()
