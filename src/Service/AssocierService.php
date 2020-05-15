<?php

namespace App\Service;

use App\Entity\Associer;
use Doctrine\ORM\EntityManagerInterface;

class AssocierService
{
    protected $em;
    protected $repository;

    /**
     * AssocierService constructor.
     *
     * @param EntityManagerInterface $em by dependency injection
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Associer::class);
    }

    /**
     * Delete a Associer object in bdd
     *
     * @param Associer $associer
     */
    public function delete(Associer $associer)
    {
        $this->em->remove($associer);
        $this->em->flush();
    }


    /**
     * Save a Associer object in bdd
     *
     * @param Associer $associer
     */
    public function save(Associer $associer)
    {
        $this->em->persist($associer);
        $this->em->flush();
    }
}
