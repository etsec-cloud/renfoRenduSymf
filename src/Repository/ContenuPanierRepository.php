<?php

namespace App\Repository;

use App\Entity\Contenupanier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contenupanier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenupanier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenupanier[]    findAll()
 * @method Contenupanier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenupanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenupanier::class);
    }

    // /**
    //  * @return Contenupanier[] Returns an array of Contenupanier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contenupanier
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
