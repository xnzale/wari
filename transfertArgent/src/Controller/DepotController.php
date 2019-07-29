<?php

namespace App\Controller;
use App\Entity\Depot;
use App\Entity\Partenaire;
use App\Repository\DepotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;



/**
 * @Route("/api")
 */

class DepotController extends AbstractController
{
    /**
     * @Route("/depot", name="depot")
     */
    public function index()
    {
        return $this->render('depot/index.html.twig', [
            'controller_name' => 'DepotController',
        ]);
    }


    /**
     * @Route("/depot", name="depot", methods={"POST"})
     
     */
    public function depot(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $depot= $serializer->deserialize($request->getContent(), Depot::class, 'json');
        $entityManager->persist($depot);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => ' Dépot réussit'
        ];
        return new JsonResponse($data, 201);
    }


}
