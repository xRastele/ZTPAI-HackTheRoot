<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class MainController
{
    #[Route('/')]
    public function homepage(): JsonResponse
    {
        return new JsonResponse(['HackTheRoot']);
    }
}