<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontstadeController extends AbstractController
{
    /**
     * @Route("/frontstade", name="frontstade")
     */
    public function index(): Response
    {
        return $this->render('frontstade/base-frontstade.html.twig', [
            'controller_name' => 'FrontstadeController',
        ]);
    }
}
