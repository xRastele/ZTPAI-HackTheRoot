<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class LeaderboardController extends AbstractController
{
    #[Route('/leaderboard', name: 'challenges_list')]
    public function leaderboard(): JsonResponse
    {

        return new JsonResponse('Leaderboard page');
    }
}

