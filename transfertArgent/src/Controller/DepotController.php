<?php

namespace App\Controller;
use App\Entity\Depot;
use App\Entity\Partenaire;
use App\Repository\DepotRepository;
use App\Repository\PartenaireRepository;
use App\Form\DepotType;
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
    public function depot(Request $request,EntityManagerInterface $entityManager,PartenaireRepository $repo ): Response
    {
        $depot = new Depot();
        $form = $this->createForm(DepotType::class, $depot);
        $data=json_decode($request->getContent(),true);
        $form->submit($data);
        $partenaire=$repo->find($data["idPartenaire"]);
        $partenaire->setSolde($partenaire->getSolde()+$depot->getMontant());
        $depot->setIdPartenaire($partenaire);
        $depot->setDateDepot(new \DateTime());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depot);
            $entityManager->persist($partenaire);

            $entityManager->flush();
        
        return new Response('Le depot a été effectuer',Response::HTTP_CREATED);
    }


}
