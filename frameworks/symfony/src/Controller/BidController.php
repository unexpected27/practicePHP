<?php

namespace App\Controller;

use App\Entity\Bid;
use App\Repository\BidRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/bids')]
#[OA\Tag(name: 'Bids')]
class BidController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private BidRepository $bidRepository,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {
    }

    #[Route('', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns the list of bids',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Bid::class, groups: ['bid:read']))
        )
    )]
    public function index(): JsonResponse
    {
        $bids = $this->bidRepository->findAll();
        $json = $this->serializer->serialize($bids, 'json', ['groups' => 'bid:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns a single bid',
        content: new OA\JsonContent(ref: new Model(type: Bid::class, groups: ['bid:read']))
    )]
    #[OA\Response(response: 404, description: 'Bid not found')]
    public function show(int $id): JsonResponse
    {
        $bid = $this->bidRepository->find($id);

        if (!$bid) {
            return $this->json(['error' => 'Bid not found'], Response::HTTP_NOT_FOUND);
        }

        $json = $this->serializer->serialize($bid, 'json', ['groups' => 'bid:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('', methods: ['POST'])]
    #[OA\RequestBody(
        content: new OA\JsonContent(ref: new Model(type: Bid::class, groups: ['bid:write']))
    )]
    #[OA\Response(
        response: 201,
        description: 'Bid created successfully',
        content: new OA\JsonContent(ref: new Model(type: Bid::class, groups: ['bid:read']))
    )]
    #[OA\Response(response: 400, description: 'Invalid input')]
    public function create(Request $request): JsonResponse
    {
        try {
            /** @var Bid $bid */
            $bid = $this->serializer->deserialize($request->getContent(), Bid::class, 'json');
            
            $errors = $this->validator->validate($bid);
            if (count($errors) > 0) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST);
            }

            $this->entityManager->persist($bid);
            $this->entityManager->flush();

            $json = $this->serializer->serialize($bid, 'json', ['groups' => 'bid:read']);
            return new JsonResponse($json, Response::HTTP_CREATED, [], true);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Invalid JSON or data'], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/{id}', methods: ['PATCH'])]
    #[OA\RequestBody(
        content: new OA\JsonContent(ref: new Model(type: Bid::class, groups: ['bid:write']))
    )]
    #[OA\Response(
        response: 200,
        description: 'Bid updated successfully',
        content: new OA\JsonContent(ref: new Model(type: Bid::class, groups: ['bid:read']))
    )]
    #[OA\Response(response: 404, description: 'Bid not found')]
    public function update(int $id, Request $request): JsonResponse
    {
        $bid = $this->bidRepository->find($id);

        if (!$bid) {
            return $this->json(['error' => 'Bid not found'], Response::HTTP_NOT_FOUND);
        }

        try {
            $this->serializer->deserialize(
                $request->getContent(),
                Bid::class,
                'json',
                ['object_to_populate' => $bid, 'groups' => 'bid:write']
            );

            $errors = $this->validator->validate($bid);
            if (count($errors) > 0) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST);
            }

            $this->entityManager->flush();

            $json = $this->serializer->serialize($bid, 'json', ['groups' => 'bid:read']);
            return new JsonResponse($json, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Invalid JSON or data'], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[OA\Response(response: 204, description: 'Bid deleted successfully')]
    #[OA\Response(response: 404, description: 'Bid not found')]
    public function delete(int $id): JsonResponse
    {
        $bid = $this->bidRepository->find($id);

        if (!$bid) {
            return $this->json(['error' => 'Bid not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($bid);
        $this->entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
