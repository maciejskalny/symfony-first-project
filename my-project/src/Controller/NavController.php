<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavController extends Controller
{
    /**
     * @Route("/nav", name="nav")
     */
    public function index()
    {
        return $this->render('nav/index.html.twig', [
            'controller_name' => 'NavController',
        ]);
    }

    public function items()
    {
        $categories = $this->getDoctrine()->getManager();

        return $this->render('nav/nav_items.html.twig',
        array('categories' => $categories));
    }
}
