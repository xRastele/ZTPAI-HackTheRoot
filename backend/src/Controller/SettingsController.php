<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class SettingsController extends AbstractController
{
    #[Route('/setting', name: 'settings_list')]
    public function settings(): JsonResponse
    {

        return new JsonResponse('Settings page');
    }
}

