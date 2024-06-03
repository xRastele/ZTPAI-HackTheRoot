<?php
namespace App\Controller;

use App\Entity\Progress;
use App\Repository\AnswerRepository;
use App\Repository\ChallengeRepository;
use App\Repository\ProgressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChallengeController extends AbstractController
{
    public function __construct(ChallengeRepository $challengeRepository,
                                AnswerRepository $answerRepository,
                                ProgressRepository $progressRepository,
                                Security $security)
    {
        $this->challengeRepository = $challengeRepository;
        $this->answerRepository = $answerRepository;
        $this->progressRepository = $progressRepository;
        $this->security = $security;
    }

    #[Route('/api/challenge/answer', name: 'api_challenge_answer', methods: ['POST'])]
    public function challengeAnswer(Request $request): JsonResponse
    {
        $user = $this->security->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        $id = $request->request->get('id');
        $flag = $request->request->get('flag');

        if ($flag) {
            //Check if user already submitted the flag
            $progress = $this->progressRepository->getProgressByChallengeIdAndUserId($user->getId(), $id);

            if ($progress && $progress->isCompleted())
                return $this->json([
                    'message' => 'Flag already submitted'
                ], Response::HTTP_BAD_REQUEST);

            //Check if flag is correct
            $answer = $this->answerRepository->findOneBy(['id' => $id]);

            if ($answer) {
                if ($answer->getFlag() == $flag) {

                    //Add progress to user for this challenge
                    $progress = new Progress();
                    $progress->setIdUser($user);
                    $progress->setIdChallenge($this->challengeRepository->find($id));
                    $progress->setCompleted(true);
                    $progress->setCompletedDate(new \DateTime());

                    $progressAdded = $this->progressRepository->addProgress($progress);

                    if ($progressAdded) {
                        return $this->json([
                            'message' => 'Flag submitted successfully'
                        ], Response::HTTP_BAD_REQUEST);
                    } else {
                        return $this->json([
                            'message' => 'Error while submitting flag, contact our support'
                        ], 400);
                    }
                }
                else {
                    //If flag is wrong
                    return $this->json([
                        'message' => 'Wrong flag provided'
                    ], Response::HTTP_BAD_REQUEST);
                }
            }
            else
                //If something went wrong
                return $this->json([
                    'message' => 'Error while submitting flag, contact our support'
                ], Response::HTTP_BAD_REQUEST);
        }

        //Error while submitting flag
        return $this->json([
            'message' => 'Error while submitting flag',
        ], Response::HTTP_BAD_REQUEST);
    }
}

