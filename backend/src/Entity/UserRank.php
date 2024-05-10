<?php

namespace App\Entity;

use App\Repository\UserRankRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRankRepository::class)]
class UserRank
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rank $rank = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->user;
    }

    public function setIdUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getIdRank(): ?Rank
    {
        return $this->rank;
    }

    public function setIdRank(?Rank $rank): static
    {
        $this->rank = $rank;

        return $this;
    }
}
