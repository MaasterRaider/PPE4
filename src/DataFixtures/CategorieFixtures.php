<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Service\CategorieService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    protected $categorieService;

    public function __construct(CategorieService $categorieService)
    {
        $this->categorieService = $categorieService;
    }

    public function load(ObjectManager $manager)
    {
        $categories = ['jeux', 'consoles', 'accessoires', 'digital'];

        foreach ($categories as $uneCategorie) {
            $categorie = new Categorie();
            $categorie->setLibelle($uneCategorie);
            $this->categorieService->save($categorie);

            $this->addReference('categorie' .  $categorie->getLibelle(), $categorie);
        }
    }
}
