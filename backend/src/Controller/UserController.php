<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{
    #[Route('/user/{id}/username', name: 'user_username')]
    public function getUsername(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            return new JsonResponse(['error' => 'No user found for id '.$id], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['username' => $user->getUsername()]);
    }

    #[Route('/user/{id}/email', name: 'user_email')]
    public function getEmail(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            return new JsonResponse(['error' => 'No user found for id '.$id], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['email' => $user->getEmail()]);
    }

    #[Route('/users', name: 'user_list')]
    public function users(EntityManagerInterface $entityManager): JsonResponse
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        $data = array_map(function(User $user) {
            return [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
                'is_admin' => $user->isAdmin()
            ];
        }, $users);

        return new JsonResponse($data);
    }
}

