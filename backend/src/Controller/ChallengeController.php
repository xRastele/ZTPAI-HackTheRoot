<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChallengeController extends AbstractController
{
    #[Route('/challenges', name: 'challenges_list')]
    public function challenges(): JsonResponse
    {

        return new JsonResponse('List of all challenges');
    }

    #[Route('/challenges/{id}', name: 'challenge_details')]
    public function detailsChallenges(int $id): JsonResponse
    {

        return new JsonResponse(['Challenge details' => $id]);
    }
}

