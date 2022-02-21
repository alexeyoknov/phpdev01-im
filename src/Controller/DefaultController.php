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
        
        $category = $em->getRepository('App:Category')->find($id);

        return $this->render('default/category.html.twig', [
            'category'=>$category
        ]);
    }
}