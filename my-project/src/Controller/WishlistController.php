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
        if($session->has('wishlist')) {
            $em = $this->getDoctrine()->getManager();

            return $this->render('wishlist/index.html.twig', [
                'wishlist' => $session->get('wishlist'),
                'products' => $em->getRepository(Product::class)->findBy(['id' => $session->get('wishlist')])
            ]);
        }

        else
        {
            return $this->render('wishlist/index.html.twig');
        }
    }

    /**
     * @Route("/wishlist/add/{id}", name="wishlist_add", methods="POST")
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

        if(sizeof($wishlist)<5) {
            array_push($wishlist, $id);
            $session->set('wishlist', $wishlist);
        }

        else{
            $session->getFlashBag()->add('error', 'You can add only 5 products to the wishlist.');
        }

        $em = $this->getDoctrine()->getManager();

        return $this->render('wishlist/index.html.twig', [
            'controller_name' => 'WishlistController',
            'wishlist' => $session->get('wishlist'),
            'products' => $em->getRepository(Product::class)->findBy(['id' => $session->get('wishlist')])
        ]);
    }

    /**
     * @Route("/wishlist/delete/{id}", name="wishlist_delete", methods="GET|POST")
     */
    public function delete(Session $session, $id)
    {
        if(!$session->isStarted()) {
            return $this->render('wishlist/index.html.twig');
        }

        if($session->has('wishlist')) {
            $wishlist = $session->get('wishlist');
        }

        unset($wishlist[array_search($id, $wishlist)]);

        if(sizeof($wishlist) == NULL)
        {
            $session->remove('wishlist');
        }

        else {
            $session->set('wishlist', $wishlist);
        }

        return $this->redirectToRoute('wishlist');
    }

    /**
     * @Route("/wishlist/delete", name="wishlist_delete_all", methods="GET|POST")
     */
    public function deleteAll(Session $session)
    {
        if(!$session->isStarted()) {
            return $this->render('wishlist/index.html.twig');
        }

        if($session->has('wishlist')) {
            $wishlist = $session->get('wishlist');
        }

        $session->remove('wishlist');

        return $this->redirectToRoute('wishlist');
    }
}