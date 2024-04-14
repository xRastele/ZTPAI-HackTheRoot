<?php

namespace App\Entity;

use App\Repository\LearningPathLessonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LearningPathLessonRepository::class)]
class LearningPathLesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?LearningPath $id_learning_path = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lesson $id_lesson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLearningPath(): ?LearningPath
    {
        return $this->id_learning_path;
    }

    public function setIdLearningPath(?LearningPath $id_learning_path): static
    {
        $this->id_learning_path = $id_learning_path;

        return $this;
    }

    public function getIdLesson(): ?Lesson
    {
        return $this->id_lesson;
    }

    public function setIdLesson(?Lesson $id_lesson): static
    {
        $this->id_lesson = $id_lesson;

        return $this;
    }
}
