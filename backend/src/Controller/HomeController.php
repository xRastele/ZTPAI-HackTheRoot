<?php

namespace App\Controller;

use App\Repository\ChallengeRepository;
use App\Repository\LeaderboardRepository;
use App\Repository\ProgressRepository;
use App\Repository\RankRepository;
use App\Repository\UserRepository;
use App\Repository\LearningPathRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ProgressRepository $progressRepository;
    private UserRepository $userRepository;
    private LearningPathRepository $learningPathRepository;
    private ChallengeRepository $challengeRepository;
    private LeaderboardRepository $leaderboardRepository;
    private RankRepository $rankRepository;

    public function __construct(
        private readonly Security $security,
        ProgressRepository        $progressRepository,
        UserRepository            $userRepository,
        LearningPathRepository    $learningPathRepository,
        ChallengeRepository       $challengeRepository,
        LeaderboardRepository     $leaderboardRepository,
        RankRepository            $rankRepository

    )
    {
        $this->progressRepository = $progressRepository;
        $this->userRepository = $userRepository;
        $this->learningPathRepository = $learningPathRepository;
        $this->challengeRepository = $challengeRepository;
        $this->leaderboardRepository = $leaderboardRepository;
        $this->rankRepository = $rankRepository;
    }

    #[Route('/api/home', name: 'api_home', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $user = $this->security->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        $userId = $user->getId();

        //Challenges completed (top left)
        $completedChallengesCount = $this->progressRepository->countCompletedChallenges($userId);

        //Rank (top left)
        $points = $this->leaderboardRepository->findPointsByUserId($userId);
        $rank = $this->rankRepository->findRankByPoints($points);

        //Recommended challenges (on the bottom)
        $challengeIds = $this->challengeRepository->findAllIds();
        $completedChallenges = $this->progressRepository->getCompletedChallengeIds($userId);

        $incompleteChallenges = array_filter($challengeIds, function($challenge) use ($completedChallenges) {
            return !in_array($challenge['id'], array_column($completedChallenges, '1'));
        });

        $challengeTitles = $this->challengeRepository->getRandomIncompleteChallengeTitles($userId, $incompleteChallenges);

        //Learning paths (in the middle)
        $learningPaths = $this->learningPathRepository->findTitlesAndDescriptions(2);

        return new JsonResponse([
            'username' => $user->getUsername(),
            'completedChallengesCount' => $completedChallengesCount,
            'challengeTitles' => $challengeTitles,
            'points' => $points,
            'rank' => $rank->getName(),
            'learningPaths' => $learningPaths
        ]);
    }
}
