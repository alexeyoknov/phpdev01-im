<?php

namespace App\Repository;

use App\Entity\ImConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImConfig[]    findAll()
 * @method ImConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImConfig::class);
    }

    // /**
    //  * @return ImConfig[] Returns an array of ImConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImConfig
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
