<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $notification_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $notification_text = null;

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

    public function getNotificationDate(): ?\DateTimeInterface
    {
        return $this->notification_date;
    }

    public function setNotificationDate(\DateTimeInterface $notification_date): static
    {
        $this->notification_date = $notification_date;

        return $this;
    }

    public function getNotificationText(): ?string
    {
        return $this->notification_text;
    }

    public function setNotificationText(string $notification_text): static
    {
        $this->notification_text = $notification_text;

        return $this;
    }
}
