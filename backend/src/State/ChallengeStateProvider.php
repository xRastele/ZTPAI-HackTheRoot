<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use App\Repository\ProgressRepository;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ChallengeStateProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.item_provider')]
        private ProviderInterface $itemProvider,

        private readonly Security           $security,
        private readonly ProgressRepository $progressRepository,
    ){}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $user = $this->security->getUser();

        $challenge = $this->itemProvider->provide($operation, $uriVariables, $context);

        if (!$user) {
            return $challenge;
        }

        $isCompleted = $this->progressRepository->getProgressByChallengeIdAndUserId($user->getId(), $challenge->getId());

        if ($isCompleted) {
            $challenge->setIsCompleted($isCompleted->isCompleted());
        }

        return $challenge;
    }
}
