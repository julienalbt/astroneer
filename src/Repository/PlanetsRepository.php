<?php

namespace App\Repository;

use App\Entity\Planets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Planets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planets[]    findAll()
 * @method Planets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanetsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Planets::class);
    }

    // /**
    //  * @return Planets[] Returns an array of Planets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Planets
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
