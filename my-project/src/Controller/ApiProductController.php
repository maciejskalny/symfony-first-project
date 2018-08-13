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
use App\Entity\ProductCategory;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
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
        $product = new Product();

        $category = $this->getDoctrine()->getRepository(ProductCategory::class)->findOneBy(['name' => $request->query->get('category')]);

        $product->setName($request->query->get('name'));
        $product->setDescription($request->query->get('description'));
        $product->setCategory($category);

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
     * @Method("PUT")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editProduct(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $id]);

        $category = $this->getDoctrine()->getRepository(ProductCategory::class)->findOneBy(['name' => $request->query->get('category')]);

        if($product) {
            $product->setName($request->query->get('name'));
            $product->setDescription($request->query->get('description'));
            $product->setCategory($category);
            $em->flush();
        }

        return new Response('Product updated', 200);
    }

    /**
     * @Route("/api/product/{id}/delete")
     * @Method("DELETE")
     * @param $id
     * @return Response
     */
    public function deleteProduct($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $id]);

        $em->remove($product);
        $em->flush();

        return new Response('Product deleted', 200);
    }
}