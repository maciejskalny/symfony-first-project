<?php

namespace App\Controller;

use App\Entity\ProductCategory;
use App\Form\ProductCategoryType;
use App\Repository\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class ProductCategoryController extends Controller
{
    /**
     * @Route("/", name="product_category_index", methods="GET")
     */
    public function index(ProductCategoryRepository $ProductCategoryRepository): Response
    {
        return $this->render('product_category/index.html.twig', ['product_categories' => $ProductCategoryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="product_category_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $ProductCategory = new ProductCategory();
        $form = $this->createForm(ProductCategoryType::class, $ProductCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ProductCategory);
            $em->flush();

            return $this->redirectToRoute('product_category_index');
        }

        return $this->render('product_category/new.html.twig', [
            'product_category' => $ProductCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_category_show", methods="GET")
     */
    public function show(ProductCategory $ProductCategory): Response
    {
        return $this->render('product_category/show.html.twig', ['product_category' => $ProductCategory]);
    }

    /**
     * @Route("/{id}/edit", name="product_category_edit", methods="GET|POST")
     */
    public function edit(Request $request, ProductCategory $ProductCategory): Response
    {
        $form = $this->createForm(ProductCategoryType::class, $ProductCategory);
        $form->handleRequest($request);
dump($form->getData());
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_category_edit', ['id' => $ProductCategory->getId()]);
        }

        return $this->render('product_category/edit.html.twig', [
            'product_category' => $ProductCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_category_delete", methods="DELETE")
     */
    public function delete(Request $request, ProductCategory $ProductCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ProductCategory->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ProductCategory);
            $em->flush();
        }

        return $this->redirectToRoute('product_category_index');
    }
}
