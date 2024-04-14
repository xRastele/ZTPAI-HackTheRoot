<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class LearningController extends AbstractController
{
    #[Route('/learning', name: 'learning_list')]
    public function learning(): JsonResponse
    {

        return new JsonResponse('Learning page');
    }

    #[Route('/learning/{id}', name: 'learning_path_list_lessons')]
    public function listLessons(int $id): JsonResponse
    {

        return new JsonResponse(['Learning path' => $id]);
    }

    #[Route('/learning/{id}/{id_lesson}', name: 'show_lesson')]
    public function detailsLesson(int $id, int $id_lesson): JsonResponse
    {

        return new JsonResponse(['Learning path' => $id, 'lesson' => $id_lesson]);
    }
}

