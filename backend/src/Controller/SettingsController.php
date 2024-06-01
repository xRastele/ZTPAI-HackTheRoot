<?php

namespace App\Controller;

use App\Repository\SettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class SettingsController extends AbstractController
{
    private $settingsRepository;
    private $security;

    public function __construct(SettingRepository $settingsRepository, Security $security)
    {
        $this->settingsRepository = $settingsRepository;
        $this->security = $security;
    }

    #[Route('/api/settings', name: 'api_settings')]
    public function getSettings(): JsonResponse
    {
        $user = $this->security->getUser();
        $settings = $this->settingsRepository->findOneBy(['user' => $user->getId()]);
        return $this->json([
            'email' => $user->getEmail(),
            'referral_code' => $settings->getReferralCode(),
            'referral_count' => $settings->getReferralCount()
        ]);
    }

    #[Route('/api/settings/referral_code', name: 'api_settings_referral_code', methods: ['POST'])]
    public function updateReferralCode(Request $request): JsonResponse
    {
        $user = $this->security->getUser();
        $newReferralCode = $request->request->get('referral_code');

        if ($newReferralCode) {
            $this->settingsRepository->updateReferralCode($user->getId(), $newReferralCode);

            return $this->json([
                'message' => 'Referral code updated successfully',
            ]);
        }

        return $this->json([
            'message' => 'No referral code provided',
        ], 400);
    }
}

