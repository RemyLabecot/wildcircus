<?php

namespace App\Repository;

use App\Entity\Circus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Circus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Circus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Circus[]    findAll()
 * @method Circus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CircusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Circus::class);
    }

    // /**
    //  * @return Circus[] Returns an array of Circus objects
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
    public function findOneBySomeField($value): ?Circus
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
