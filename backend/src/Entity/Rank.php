<?php

namespace App\Entity;

use App\Repository\RankRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RankRepository::class)]
class Rank
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $min_points = null;

    #[ORM\Column]
    private ?int $max_points = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMinPoints(): ?int
    {
        return $this->min_points;
    }

    public function setMinPoints(int $min_points): static
    {
        $this->min_points = $min_points;

        return $this;
    }

    public function getMaxPoints(): ?int
    {
        return $this->max_points;
    }

    public function setMaxPoints(int $max_points): static
    {
        $this->max_points = $max_points;

        return $this;
    }
}
