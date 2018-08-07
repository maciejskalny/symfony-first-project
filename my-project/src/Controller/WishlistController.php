<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WishlistController extends Controller
{

    /**
     * @Route("/wishlist", name="wishlist")
     */
    public function index(Session $session)
    {
        $em = $this->getDoctrine()->getManager();


        return $this->render('wishlist/index.html.twig', [
            'controller_name' => 'WishlistController',
            'wishlist' => $session->get('wishlist'),
            'products' => $em->getRepository(Product::class)->findBy(['id' => $session->get('wishlist')])
        ]);
    }

    /**
     * @Route("/wishlist/add/{id}", name="wishlist_add", methods="GET|POST")
     */
    public function new(Session $session, $id)
    {
        if(!$session->isStarted()) {
            $session->start();
        }

        if($session->has('wishlist')) {
        $wishlist = $session->get('wishlist');
        }

        else {
            $wishlist = array();
        }

        array_push($wishlist, $id);

        $session->set('wishlist', $wishlist);

        return $this->render('wishlist/index.html.twig', [
            'controller_name' => 'WishlistController',
            'wishlist' => $session->get('wishlist')
        ]);
    }
}