<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Service\UtilisateurService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture
{
    protected $utilisateurService;

    public function __construct(UtilisateurService $utilisateurService)
    {
        $this->utilisateurService = $utilisateurService;
    }

    public function load(ObjectManager $manager)
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setRoles(["ROLE_ADMIN"]);
        $utilisateur->setNom('Normand');
        $utilisateur->setPrenom('Théo');
        $utilisateur->setEmail('normand.theo@gmail.com');
        $utilisateur->setNumeroTelephone('0606060606');
        $utilisateur->setDateNaissance(new \DateTime('2000-01-01'));
        $utilisateur->setPlainPassword('123456');
        $this->utilisateurService->save($utilisateur);
    }
}
