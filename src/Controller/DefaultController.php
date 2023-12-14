<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/connexion', name: 'default.login', methods: ['GET'])]
    public function login(): Response
    {
        return $this->render('login.html.twig');
    }

    #[Route('/inscription', name: 'default.register', methods: ['GET'])]
    public function register(): Response
    {
        return $this->render('register.html.twig');
    }

    #[Route('/contact', name: 'default.contact', methods: ['GET'])]
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }
}
