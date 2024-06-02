<?php

namespace App\State;

use App\Repository\ProgressRepository;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ChallengeCollectionStateProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $collectionProvider,
        private readonly Security           $security,
        private readonly ProgressRepository $progressRepository,
    ){}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $user = $this->security->getUser();

        $challenges = $this->collectionProvider->provide($operation, $uriVariables, $context);

        if (!$user) {
            return $challenges;
        }

        foreach ($challenges as $challenge) {
            $isCompleted = $this->progressRepository->getProgressByChallengeIdAndUserId($user->getId(), $challenge->getId());

            if ($isCompleted) {
                $challenge->setIsCompleted($isCompleted->isCompleted());
            }
        }

        return $challenges;
    }
}