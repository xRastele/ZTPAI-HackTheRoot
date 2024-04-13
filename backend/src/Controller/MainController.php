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

    #[Route('/challenges/{id}', name: 'challenges')]
    public function challenges(int $id): JsonResponse
    {
        return new JsonResponse(['message' => 'Challenges page', 'id' => $id]);
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