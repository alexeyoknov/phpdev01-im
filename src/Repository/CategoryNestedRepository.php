<?php

namespace App\Repository;

use App\Entity\CategoryNested;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * @method CategoryNested|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryNested|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryNested[]    findAll()
 * @method CategoryNested[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryNestedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryNested::class);
    }
    
    /**
     * @return CategoryNested[] Returns an array of CategoryNested objects
     */
    public function findAll()
    {
        return $this->findBy([],['root'=>'ASC','lft'=>'ASC']);

    }

    // /**
    //  * @return CategoryNested[] Returns an array of CategoryNested objects
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
    public function findOneBySomeField($value): ?CategoryNested
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
