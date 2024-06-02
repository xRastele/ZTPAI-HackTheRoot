<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\Repository\ChallengeRepository;
use App\State\ChallengeCollectionStateProvider;
use App\State\ChallengeStateProvider;
use Doctrine\ORM\Mapping as ORM;
#[ApiResource(
    operations: [
        new GetCollection(provider: ChallengeCollectionStateProvider::class),
        new Get(provider: ChallengeStateProvider::class),
    ]
)]
#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reward $reward = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Difficulty $difficulty = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    private ?bool $is_completed = false;

    public function getIsCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setIsCompleted(?bool $is_completed): void
    {
        $this->is_completed = $is_completed;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReward(): ?Reward
    {
        return $this->reward;
    }

    public function setIdReward(?Reward $reward): static
    {
        $this->reward = $reward;

        return $this;
    }

    public function getIdDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setIdDifficulty(?Difficulty $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
