<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Service\ProduitService;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    protected $produitService;
    protected $slugify;

    public function __construct(ProduitService $produitService, SlugifyInterface $slugify)
    {
        $this->produitService = $produitService;
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $lesProduits = [
            [
                'libelle' => 'PS4',
                'description' => 'Une superbe console de jeu qui a fait ses preuves.',
                'prixht' => '199',
                'stock' => '10'
            ],
            [
                'libelle' => 'Xbox One',
                'description' => 'Une console de jeu qui saura vous satisfaire',
                'prixht' => '199',
                'stock' => '5'
            ],
            [
                'libelle' => 'Battlefield V',
                'description' => 'Le plus réaliste des jeux de combat',
                'prixht' => '39',
                'stock' => '7'
            ],
        ];

        foreach ($lesProduits as $key => $unProduit) {
            $produit = new Produit();
            $produit->setLibelle($unProduit['libelle']);
            $produit->setDescription($unProduit['description']);
            $produit->setPrixht($unProduit['prixht']);
            $produit->setStock($unProduit['stock']);
            $this->produitService->save($produit);

            $this->addReference('produit' . $this->slugify->slugify($produit->getLibelle()), $produit);
        }
    }
}
