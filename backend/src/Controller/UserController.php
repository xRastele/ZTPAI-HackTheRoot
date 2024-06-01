<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\LeaderboardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{
    private LeaderboardRepository $leaderboardRepository;

    public function __construct(
        private readonly Security $security,
        LeaderboardRepository     $leaderboardRepository,
    ) {
        $this->leaderboardRepository = $leaderboardRepository;
    }

     #[Route('/api/user', name: 'api_user', methods: ['GET'])]
     public function index(): JsonResponse
     {
         $user = $this->security->getUser();

         if (!$user) {
             return new JsonResponse(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
         }

         $username = $user->getUsername();

         $userId = $user->getId();
         $points = $this->leaderboardRepository->findPointsByUserId($userId);

         return new JsonResponse([
             'username' => $username,
             'points' => $points
         ]);
     }
}