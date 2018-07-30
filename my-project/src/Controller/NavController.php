<?php

namespace App\Controller;

use App\Entity\ProductCategory;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\ProductCategoryRepository;

class NavController extends Controller
{

    public function items(ProductCategoryRepository $categories)
    {
        return $this->render('nav/nav_items.html.twig', ['categories' => $categories->findAll()]);
    }
}

