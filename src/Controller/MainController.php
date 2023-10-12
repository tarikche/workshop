<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/start', name: 'start')]
    public function index(): Response
    {
        return $this->render('start.html.twig');
    }

    #[Route('/question2', name: 'question2')]
    public function question2(): Response
    {
        return $this->render('question2.html.twig');
    }

    #[Route('/question3', name: 'question3')]
    public function question3(): Response
    {
        return $this->render('question3.html.twig');
    }


}
