<?php

namespace App\Controller;
use App\Entity\superUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
/**
 * @Route("/api")
 */
class WariController extends AbstractController
{
    /**
     * @Route("/wari", name="wari")
     */
    public function index()
    {
        return $this->render('wari/index.html.twig', [
            'controller_name' => 'WariController',
        ]);
    }
}
