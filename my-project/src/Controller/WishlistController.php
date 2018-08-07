<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WishlistController extends Controller
{
//    /**
//     * @Route("/wishlist", name="wishlist")
//     */
//    public function index(Session $session)
//    {
//        $session->start();
//        return $this->render('wishlist/index.html.twig', [
//            'controller_name' => 'WishlistController',
//            'products' => $session->get('product')
//        ]);
//    }

    /**
     * @Route("/wishlist/{id}", name="wishlist_add", methods="GET|POST")
     */
    public function new(Session $session, $id)
    {

        if(!$session->isStarted())
        $session->start();

        if($session->has('products'))
        $products = $session->get('products');

        else
            $products = array();

            array_push($products, $id);


            $session->set('products', $products);

        return $this->render('wishlist/index.html.twig', [
            'controller_name' => 'WishlistController',
            'products' => $session->get('products')
        ]);
    }

}
