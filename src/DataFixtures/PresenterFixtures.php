<?php

namespace App\DataFixtures;

use App\Entity\Presenter;
use App\Service\PresenterService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PresenterFixtures extends Fixture implements DependentFixtureInterface
{
    protected $presenterService;

    public function __construct(PresenterService $presenterService)
    {
        $this->presenterService = $presenterService;
    }

    public function load(ObjectManager $manager)
    {
        $lesPresenter = [
            [
                'idImage' => $this->getReference('imagebfv'),
                'idProduit' => $this->getReference('produitbattlefield-v')
            ],
            [
                'idImage' => $this->getReference('imagexbox'),
                'idProduit' => $this->getReference('produitxbox-one')
            ],
            [
                'idImage' => $this->getReference('imageps4'),
                'idProduit' => $this->getReference('produitps4')
            ]
        ];

        foreach ($lesPresenter as $unPresenter) {
            $presenter = new Presenter();
            $presenter->setIdImage($unPresenter['idImage']);
            $presenter->setIdProduit($unPresenter['idProduit']);
            $this->presenterService->save($presenter);
        }
    }

    public function getDependencies()
    {
        return array(
            ImageFixtures::class,
            ProduitFixtures::class
        );
    }
}
