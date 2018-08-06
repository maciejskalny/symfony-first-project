<?php
/**
 * Created by PhpStorm.
 * User: virtua
 * Date: 03.08.2018
 * Time: 10:09
 */

namespace App\Service;

use App\Entity\ProductImage;
use App\Entity\Product;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class ProductMainImage
{
    private $imagesDirectory;

    public function __construct($imagesDirectory)
    {
        $this->imagesDirectory = $imagesDirectory;
    }

    public function addingProductMainImage($product, $mainImage)
    {
        $parameterValue = $this->imagesDirectory;

        $file = new ProductImage();

        $ext = $mainImage->guessExtension();
        $product->setMainImage($mainImage . '.' .$ext);

        $file->setName($mainImage . '.' .$ext);
        $product->addImage($file);

        $mainImage->move(
            $parameterValue,
            $file->getName()
        );

        $product->setMainImage(substr(strrchr($mainImage, "/"), 1) . '.' . $ext);
        $file->setName(substr(strrchr($mainImage, "/"), 1) . '.' . $ext);
    }
}