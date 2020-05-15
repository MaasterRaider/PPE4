<?php

namespace App\Service;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;

class ImageService
{
    protected $em;
    protected $repository;

    /**
     * ImageService constructor.
     *
     * @param EntityManagerInterface $em by dependency injection
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Image::class);
    }

    /**
     * Delete a Image object in bdd
     *
     * @param Image $image
     */
    public function delete(Image $image)
    {
        $this->em->remove($image);
        $this->em->flush();
    }


    /**
     * Save a Image object in bdd
     *
     * @param Image $image
     */
    public function save(Image $image)
    {
        $this->em->persist($image);
        $this->em->flush();
    }
}
