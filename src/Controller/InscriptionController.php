<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class InscriptionController extends AbstractController
{

    /**
     * @Route("/inscription", name="inscription")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('inscription/inscription.html.twig');
    }
}