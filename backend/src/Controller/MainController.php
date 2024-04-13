<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class MainController
{
    #[Route('/')]
    public function homepage(): JsonResponse
    {
        return new JsonResponse(['message' => 'HackTheRoot']);
    }

    #[Route('/learning')]
    public function learning(): JsonResponse
    {
        return new JsonResponse(['message' => 'Learning page']);
    }

    #[Route('/challenges', name: 'challenges')]
    public function listChallenges(): JsonResponse
    {

        return new JsonResponse(['message' => 'List of all challenges']);
    }

    #[Route('/challenges/{id}', name: 'challenge_details')]
    public function challengeDetails(int $id): JsonResponse
    {

        return new JsonResponse(['message' => 'Challenge details', 'id' => $id]);
    }

    #[Route('/leaderboard')]
    public function leaderboard(): JsonResponse
    {
        return new JsonResponse(['message' => 'Leaderboard page']);
    }

    #[Route('/settings')]
    public function settings(): JsonResponse
    {
        return new JsonResponse(['message' => 'Settings page']);
    }
}