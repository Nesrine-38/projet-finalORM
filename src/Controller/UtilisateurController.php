<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/utilisateur')]
class UtilisateurController extends AbstractController
{

    public function __construct(private UtilisateurRepository $userrepo, private EntityManagerInterface $em) {}

    #[Route(methods: 'GET')]
    public function all(): JsonResponse
    {
        return $this->json($this->userrepo->findAll());
    }

    #[Route('/{id}', methods: 'GET')]
    public function one(Utilisateur $utilisateur) {
        return $this->json($utilisateur);
    }

    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer): JsonResponse {
        try {
            $utilisateur = $serializer->deserialize($request->getContent(), Utilisateur::class, 'json');
        } catch (\Exception $e) {
            return $this->json('Invalid Body', 400);
        }

        $this->em->persist($utilisateur);
        $this->em->flush();
        return $this->json($utilisateur, 201);

    }

    #[Route('/{id}', methods: 'DELETE')]
    public function delete(Utilisateur $utilisateur): JsonResponse {
        $this->em->remove($utilisateur);
        $this->em->flush();
        return $this->json(null, 204);
    }
    
    #[Route('/{id}', methods: 'PATCH')]
    public function update(Utilisateur $utilisateur, Request $request, SerializerInterface $serializer): JsonResponse {
        try {
            $serializer->deserialize($request->getContent(), Student::class, 'json', [
                'object_to_populate' => $utilisateur
            ]);
        } catch (\Exception $th) {
            return $this->json('Invalid body', 400);
        }

        $this->em->flush();

        return $this->json($utilisateur);
    }
}