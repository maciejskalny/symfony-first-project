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
use App\Form\ProductType;
use App\Repository\ProductRepository;
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
    public function newProduct(Request $request)
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

    /**
     * @Route("/api/product/{id}")
     * @Method("GET")
     * @param $id
     * @return Response
     */
    public function showProduct($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $id]);

        $data = [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'category' => $product->getCategory(),
            'created_at' => $product->getAddDate(),
            'last_modified' => $product->getLastModifiedDate(),
        ];

        return new Response(json_encode($data));
    }

    /**
     * @Route("/api/product/{id}/edit")
     * @Method("POST")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editProduct(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $id]);

        if($product)
        {
            $product->setName($request->get('name'));
            $product->setDescription($request->get('description'));
            $em->flush();
        }

        return new Response('Product updated', 200);
    }

}