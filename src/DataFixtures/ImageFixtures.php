<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Service\ImageService;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    protected $imageService;
    protected $slugify;

    public function __construct(ImageService $imageService, SlugifyInterface $slugify)
    {
        $this->imageService = $imageService;
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $images = [
            [
                'chemin' => 'bfv',
                'typeImage' => $this->getReference('typeImagejpg')
            ],
            [
                'chemin' => 'ps4',
                'typeImage' => $this->getReference('typeImagejpg')
            ],
            [
                'chemin' => 'xbox',
                'typeImage' => $this->getReference('typeImagejpg')
            ]
        ];

        foreach ($images as $uneImage) {
            $image = new Image();
            $image->setChemin($uneImage['chemin']);
            $image->setIdTypeImage($uneImage['typeImage']);
            $this->imageService->save($image);

            $this->addReference('image' . $this->slugify->slugify($image->getChemin()), $image);
        }
    }

    public function getDependencies()
    {
        return array(
            TypeImageFixtures::class
        );
    }
}
