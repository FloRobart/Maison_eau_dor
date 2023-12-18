<?php

namespace App\Controller\BackOffice; // Pourrait aussi être App\Controller\BackOffice\InsertionBase

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexCreationBaseController extends AbstractController
{
    #[Route('/insertion/base', name: 'insertion_index')]
    public function index(): Response
    {
        return $this->render('insertion_base/index.html.twig', [
            'controller_name' => 'IndexCreationBaseController',
        ]);
    }
}
