<?php

namespace App\Repository;

use App\Entity\ImSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImSettings[]    findAll()
 * @method ImSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImSettings::class);
    }

    public function findOneById($value): ?ImSettings
    {
        return $this->createQueryBuilder('i')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return ImSettings[] Returns an array of ImSettings objects
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
    public function findOneBySomeField($value): ?ImSettings
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
