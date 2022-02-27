<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class DefaultController extends AbstractController
{
    public const tableClassTypes = [
        0 => [ 'category' =>  'App:Category', 'product' => 'App:Product', 'type' => 'common' ],
        1 => [ 'category' =>  'App:CategoryNested', 'product' => 'App:ProductNested', 'type' => 'nested' ],
    ];

    private $tableType = 0;

    public function getTableType()
    {
        $em = $this->getDoctrine()->getManager();
        $cr = $em->getRepository('App:ImSettings')->findOneById(null);
        $this->tableType = $cr ? $cr->getUseNestedTable() : 0;
        return self::tableClassTypes[$this->tableType];
    }

    /**
     * @throws \Exception
     */
    public function homepage(EntityManagerInterface $em, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $cr = $em->getRepository($this->getTableType()['category']);

        $categories = $cr->findAll();
        //\var_dump($categories); exit;

        return $this->render('default/index.html.twig', [
            'categories' => $categories,
            'type' => self::tableClassTypes[$this->tableType]['type']
        ]);
    }

    public function category(int $id, EntityManagerInterface $em)
    {
        
        $category = $em->getRepository($this->getTableType()['category'])->findOneBy(['id'=>$id,'active'=>true],null,1);

        return $this->render('default/category.html.twig', [
            'category'=>$category
        ]);
    }

    public function product(int $id, EntityManagerInterface $em)
    {
        
        $product = $em->getRepository($this->getTableType()['product'])->find($id);

        return $this->render('default/product.html.twig', [
            'product'=>$product
        ]);
    } 
    
    public function getProducts(int $categoryId, EntityManagerInterface $em)
    {
        
        $products = $em->getRepository($this->getTableType()['category'])->findOneBy(['id'=>$categoryId]);

        return $this->render('default/products.html.twig', [
            'products'=>$products->getProducts()
        ]);
    } 

    public function getCategories(EntityManagerInterface $em,$parent=null)
    {
        $categories = $em->getRepository($this->getTableType()['category'])->findBy(['active'=>true, 'Parent'=>$parent]);

        return $this->render('default/leftsidebar.html.twig', [
            'categories' => $categories            
        ]);
    }
    
    public function getSubCategories(EntityManagerInterface $em,$parent=null)
    {
        $categories = $em->getRepository($this->getTableType()['category'])->findBy([
            'active'=>true, 'Parent'=>$parent]);

        return $this->render('default/subcategories.html.twig', [
            'categories' => $categories            
        ]);
    } 

    public function getCategoriesPath($id=null, $isProductPage=false)
    {
        $path = [];
        $em = $this->getDoctrine()->getManager();
        $current = $em->getRepository($this->getTableType()['category'])->findOneBy([
            //'active'=>true,
            'id'=>$id
        ]);

        if ($isProductPage) {
            $url = $this->generateUrl('category',['id'=>$current->getId()]);
            $path[] = "<a href=$url >".(string) $current . "</a>";
        }

        /*
            здесь в идеале надо реализовать для нестед правильную выборку 
        */
        
        while($current)
        {
            $current = $current->getParent() ? 
                $em->getRepository($this->getTableType()['category'])->findOneBy([
                //'active'=>true,
                'id'=>$current->getParent()
                ])
                : null;

            if ($current)
            {
                $url = $this->generateUrl('category',['id'=>$current->getId()]);
                array_unshift($path,"<a href=$url >".(string) $current . "</a>");
            }
        }  
        
        return new Response(implode(' / ', $path) . " /");
    } 
    
}