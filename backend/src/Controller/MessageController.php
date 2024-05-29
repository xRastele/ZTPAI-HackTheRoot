<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\YourMessage;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    #[Route('/send_message', name: 'send_message')]
    public function sendMessage(MessageBusInterface $bus): JsonResponse
    {
        $message = new YourMessage('Hello RabbitMQ!');
        $bus->dispatch($message);

        return $this->json(['status' => 'Message sent!']);
    }
}
