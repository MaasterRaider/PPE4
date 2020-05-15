<?php

namespace App\DataFixtures;

use App\Entity\Associer;
use App\Service\AssocierService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AssocierFixtures extends Fixture implements DependentFixtureInterface
{
    protected $associerService;
    protected $slugify;

    public function __construct(AssocierService $associerService)
    {
        $this->associerService = $associerService;
    }

    public function load(ObjectManager $manager)
    {
        $associers = [
            [
                'idProduit' => $this->getReference('produitbattlefield-v'),
                'idCategorie' => $this->getReference('categoriejeux')
            ],
            [
                'idProduit' => $this->getReference('produitxbox-one'),
                'idCategorie' => $this->getReference('categorieconsoles')
            ],
            [
                'idProduit' => $this->getReference('produitps4'),
                'idCategorie' => $this->getReference('categorieconsoles')
            ]
        ];

        foreach ($associers as $uneAssocier) {
            $associer = new Associer();
            $associer->setIdProduit($uneAssocier['idProduit']);
            $associer->setIdCategorie($uneAssocier['idCategorie']);
            $this->associerService->save($associer);
        }
    }

    public function getDependencies()
    {
        return array(
            CategorieFixtures::class,
            ProduitFixtures::class
        );
    }
}
