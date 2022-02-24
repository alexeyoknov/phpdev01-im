<?php

namespace App\Repository;

use App\Entity\ProductNested;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductNested|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductNested|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductNested[]    findAll()
 * @method ProductNested[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductNestedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductNested::class);
    }

    // /**
    //  * @return ProductNested[] Returns an array of ProductNested objects
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
    public function findOneBySomeField($value): ?ProductNested
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
