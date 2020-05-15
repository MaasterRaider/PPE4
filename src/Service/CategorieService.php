<?php

namespace App\Service;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;

class CategorieService
{
    protected $em;
    protected $repository;

    /**
     * CategorieService constructor.
     *
     * @param EntityManagerInterface $em by dependency injection
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Categorie::class);
    }

    /**
     * Delete a Categorie object in bdd
     *
     * @param Categorie $categorie
     */
    public function delete(Categorie $categorie)
    {
        $this->em->remove($categorie);
        $this->em->flush();
    }


    /**
     * Save a Categorie object in bdd
     *
     * @param Categorie $categorie
     */
    public function save(Categorie $categorie)
    {
        $this->em->persist($categorie);
        $this->em->flush();
    }
}
