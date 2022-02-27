<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
    * @return Category[] Returns an array of Category objects
    */
    public function findAll()
    {
        
        //return parent::findAll();
        
        $em = $this->getEntityManager();

        return $em->createQueryBuilder()
            ->select(
                "c.id as id, c.name as name, c.created as created, c.active as active,
                 c.updated as updated, c2.name as parentName, c2.id as sid,
                 CONCAT(COALESCE(CONCAT(c2.name,'.'),''),COALESCE(c.name,'')) as p,
                 count(pr.id) as productsCount")
            ->from("App\Entity\Category", "c")
            ->leftJoin(Category::class,'c2','WITH','c2.id = c.Parent')
            ->leftJoin(Product::class,'pr','WITH','pr.Category = c.id')
            ->groupBy("c.id")
            ->orderBy('p', 'ASC')
            ->getQuery()
            ->getScalarResult()
            //->getSQL()
            ;
    }    

    // /**
    //  * @return Category[] Returns an array of Category objects
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
    public function findOneBySomeField($value): ?Category
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
