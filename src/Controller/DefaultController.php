<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @throws \Exception
     */
    public function homepage(EntityManagerInterface $em, Request $request): Response
    {
        $cr = $em->getRepository('App:Category');
        $categories = $cr->findAll();

        return $this->render('default/index.html.twig', [
            'categories'=>$categories
        ]);
    }

    public function category(int $id, EntityManagerInterface $em)
    {
        
        $category = $em->getRepository('App:Category')->findBy(['id'=>$id,'active'=>true],null,1);

        return $this->render('default/category.html.twig', [
            'category'=>$category[0]
        ]);
    }

    public function product(int $id, EntityManagerInterface $em)
    {
        
        $product = $em->getRepository('App:Product')->find($id);

        return $this->render('default/product.html.twig', [
            'product'=>$product
        ]);
    } 
    
    public function getCategories(EntityManagerInterface $em,$parent=null)
    {
        $categories = $em->getRepository('App:Category')->findBy(['active'=>true, 'Parent'=>$parent]);

        return $this->render('default/leftsidebar.html.twig', [
            'categories' => $categories            
        ]);
    }
    
    public function getSubCategories(EntityManagerInterface $em,$parent=null)
    {
        $categories = $em->getRepository('App:Category')->findBy([
            'active'=>true, 'Parent'=>$parent]);

        return $this->render('default/subcategories.html.twig', [
            'categories' => $categories            
        ]);
    } 

    public function getCategoriesPath($id=null, $isProductPage=false)
    {
        $path = [];
        $em = $this->getDoctrine()->getManager();
        $current = $em->getRepository('App:Category')->findOneBy([
            //'active'=>true,
            'id'=>$id
        ]);

        if ($isProductPage) {
            $url = $this->generateUrl('category',['id'=>$current->getId()]);
            $path[] = "<a href=$url >".(string) $current . "</a>";
        }
        
        while($current)
        {
            $current = $current->getParent() ? 
                $em->getRepository('App:Category')->findOneBy([
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