<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $referral_code = null;

    #[ORM\Column]
    private ?int $referral_count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferralCode(): ?string
    {
        return $this->referral_code;
    }

    public function setReferralCode(string $referral_code): static
    {
        $this->referral_code = $referral_code;

        return $this;
    }

    public function getReferralCount(): ?int
    {
        return $this->referral_count;
    }

    public function setReferralCount(int $referral_count): static
    {
        $this->referral_count = $referral_count;

        return $this;
    }
}
