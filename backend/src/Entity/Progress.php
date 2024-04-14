<?php

namespace App\Entity;

use App\Repository\ProgressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgressRepository::class)]
class Progress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Challenge $id_challenge = null;

    #[ORM\Column]
    private ?bool $is_completed = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $completed_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdChallenge(): ?Challenge
    {
        return $this->id_challenge;
    }

    public function setIdChallenge(?Challenge $id_challenge): static
    {
        $this->id_challenge = $id_challenge;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setCompleted(bool $is_completed): static
    {
        $this->is_completed = $is_completed;

        return $this;
    }

    public function getCompletedDate(): ?\DateTimeInterface
    {
        return $this->completed_date;
    }

    public function setCompletedDate(\DateTimeInterface $completed_date): static
    {
        $this->completed_date = $completed_date;

        return $this;
    }
}
