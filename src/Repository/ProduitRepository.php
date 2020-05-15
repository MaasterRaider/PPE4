<?php

namespace App\Repository;

use App\Entity\Image;
use App\Entity\Presenter;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     * @return array
     */
    public function findLastFourProducts()
    {
        $produitIds = $this->createQueryBuilder('p')
            ->select('p.id')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        foreach ($produitIds as $produit) {
            $produits[] = $produit['id'];
        }

        return $this->findProductsPictures($produits);
    }

    /**
     * @param $produits
     * @return array
     */
    public function findProductsPictures($produits)
    {
        return $this->getEntityManager()
            ->getRepository(Presenter::class)
            ->createQueryBuilder('p')
            ->join('p.idImage', 'i')
            ->join('i.idTypeImage', 't')
            ->where('p.idProduit IN (:idProduit)')
            ->setParameter('idProduit', $produits)
            ->getQuery()
            ->getResult();
    }

//     /**
//      * @return Produit[] Returns an array of Produit objects
//      */
    /*    public function findByExampleField($value)
        {
            return $this->createQueryBuilder('p')
                ->andWhere('p.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('p.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getResult()
            ;
        }*/

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
