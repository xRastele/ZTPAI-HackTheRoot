<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\StartChallengeMessage;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    private $bus;
    private int $challengeTimeMins = 10;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }
    #[Route('/api/start_challenge', name: 'api_start_challenge', methods: ['POST'])]
    public function startChallenge(Request $request): JsonResponse
    {
        $challengeId = $request->get('challenge_id');

        if($challengeId
            && is_numeric($challengeId)
            && preg_match('/^[0-9]+$/', $challengeId)
            && $challengeId > 0
            && $challengeId < 1000)
        {
            $timeout = $this->challengeTimeMins * 60;
            $message = new StartChallengeMessage($challengeId, $timeout);

            $this->bus->dispatch($message);

            $mainPort = 8000;
            $newPort = $mainPort + $challengeId;
            $challengePath = "http://localhost:$newPort/";

            return $this->json(['status' => 'Machine started', 'challenge_path' => $challengePath, 'timeout' => $timeout], 200);
        }
        else
        {
            return $this->json(['status' => 'Error while starting machine, please try again'], 400);
        }

    }
}
