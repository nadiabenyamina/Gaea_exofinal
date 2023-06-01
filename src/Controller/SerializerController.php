<?php

namespace App\Controller;

use App\Repository\PossessionsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerController extends AbstractController
{    
    // Serialisation table User
    #[Route('/usersData', name: 'user_data', methods: 'GET')]
    public function usersData(UsersRepository $usersRepository, SerializerInterface $serializer): JsonResponse
    {
        $usersList = $usersRepository->findAll();
        $jsonUsersList = $serializer->serialize($usersList, 'json');

        return new JsonResponse($jsonUsersList, Response::HTTP_OK, [], true);
    }

    // Fonction delete table user
    #[Route('/usersData/{id}', name: 'delete_user', methods: 'DELETE')]
    public function deleteUser($id, UsersRepository $usersRepository, EntityManagerInterface $entityManager)
    {
        $user = $usersRepository->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }
        
        $entityManager->remove($user);
        $entityManager->flush();
        return new JsonResponse(['message' => "L'utilisateur a bien été supprimé."]);
    }

    // Serialisation table Possession
    #[Route('/usersPossessions', name: 'users_possession', methods: 'GET')]
    public function userPossession(PossessionsRepository $possessionsRepository, SerializerInterface $serializer): JsonResponse
    {
        $possessionList = $possessionsRepository->findAll();
        $jsonPossessionList = $serializer->serialize($possessionList, 'json');

        return new JsonResponse($jsonPossessionList, Response::HTTP_OK, [], true);
    }
}
