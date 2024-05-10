<?php

namespace App\Entity;

use App\Repository\ChallengeRepository;
use Doctrine\ORM\Mapping as ORM;

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
}
