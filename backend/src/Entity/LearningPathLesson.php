<?php

namespace App\Entity;

use App\Repository\LearningPathLessonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LearningPathLessonRepository::class)]
class LearningPathLesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?LearningPath $learning_path = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lesson $lesson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLearningPath(): ?LearningPath
    {
        return $this->learning_path;
    }

    public function setIdLearningPath(?LearningPath $learning_path): static
    {
        $this->learning_path = $learning_path;

        return $this;
    }

    public function getIdLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setIdLesson(?Lesson $lesson): static
    {
        $this->lesson = $lesson;

        return $this;
    }
}
