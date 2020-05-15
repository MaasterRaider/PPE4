<?php

namespace App\Controller;


use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DetailsController extends AbstractController
{

    /**
     * @Route("/produit/{id}", name="produit")
     * @return Response
     */
    public function produit(Produit $produit): Response
    {
        return $this->render('details/produit.html.twig', [
            'produit' => $produit,
        ]);
    }
}