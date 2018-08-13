<?php

/**
 * This file is a controller which supports Product Rest api.
 * @category Controller
 * @Package Virtua_Internship
 * @copyright Copyright (c) 2018 Virtua (http://www.wearevirtua.com)
 * @author Maciej Skalny contact@wearevirtua.com
 */

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ApiProductController extends Controller
{
    /**
     * @Route("api/product")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $nameQuery = $request->query->get('name');
        $descriptionQuery = $request->query->get('description');

        $product = new Product();

        $product->setName($nameQuery);
        $product->setDescription($descriptionQuery);
        $product->setCategory(null);

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        return new Response('New product added', 201);
    }

}