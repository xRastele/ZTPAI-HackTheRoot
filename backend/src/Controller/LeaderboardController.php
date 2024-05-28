<?php
namespace App\Controller;

use App\Repository\LeaderboardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class LeaderboardController extends AbstractController
{

    #[Route('/api/leaderboard', name: 'leaderboard')]
    public function getLeaderboard(LeaderboardRepository $leaderboardRepository): JsonResponse
    {
        $leaderboard = $leaderboardRepository->findAllUsernamePoints();
        return $this->json($leaderboard);
    }
}

