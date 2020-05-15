<?php

namespace App\Service;

use App\Entity\Presenter;
use Doctrine\ORM\EntityManagerInterface;

class PresenterService
{
    protected $em;
    protected $repository;

    /**
     * PresenterService constructor.
     *
     * @param EntityManagerInterface $em by dependency injection
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(Presenter::class);
    }

    /**
     * Delete a Presenter object in bdd
     *
     * @param Presenter $presenter
     */
    public function delete(Presenter $presenter)
    {
        $this->em->remove($presenter);
        $this->em->flush();
    }


    /**
     * Save a Presenter object in bdd
     *
     * @param Presenter $presenter
     */
    public function save(Presenter $presenter)
    {
        $this->em->persist($presenter);
        $this->em->flush();
    }
}
