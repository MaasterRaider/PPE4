<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/api", name="api_")
 */
class WebServicesController extends AbstractController
{
    /**
     * @Route("/produit/all", name="produit_all")
     */
    public function index()
    {
        $lesProduits = $this->getDoctrine()->getRepository(Produit::class)->findAll();

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $reponse = new Response();
        $reponse->setContent($serializer->serialize($lesProduits, 'json'));
        $reponse->headers->set('Content-Type', 'application/json');
        return $reponse;
    }

    /**
     * @Route("/utilisateur/all", name="utilisateur_all")
     */
    public function index2()
    {
        $lesUtilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $reponse = new Response();
        $reponse->setContent($serializer->serialize($lesUtilisateurs, 'json'));
        $reponse->headers->set('Content-Type', 'application/json');
        return $reponse;
    }
}
