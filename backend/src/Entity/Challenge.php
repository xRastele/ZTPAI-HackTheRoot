<?php

namespace App\Entity;

use App\Repository\ChallengeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reward $id_reward = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Difficulty $id_difficulty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReward(): ?Reward
    {
        return $this->id_reward;
    }

    public function setIdReward(?Reward $id_reward): static
    {
        $this->id_reward = $id_reward;

        return $this;
    }

    public function getIdDifficulty(): ?Difficulty
    {
        return $this->id_difficulty;
    }

    public function setIdDifficulty(?Difficulty $id_difficulty): static
    {
        $this->id_difficulty = $id_difficulty;

        return $this;
    }
}
