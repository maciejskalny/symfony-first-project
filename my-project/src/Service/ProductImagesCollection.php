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
use Symfony\Component\Filesystem\Filesystem;

class ProductImagesCollection
{

    private $imagesDirectory;

    public function __construct($imagesDirectory)
    {
        $this->imagesDirectory = $imagesDirectory;
    }

    public function addingProductImagesCollection($product, $images){

        $parameterValue = $this->imagesDirectory;

        foreach($images as $image)
        {

            $file = new ProductImage();
            $ext = $image->guessExtension();
            $file->setName($image.".".$ext);

            $product->addImage($file);

            $image->move(
                $parameterValue,
                $file->getName()
            );

            $file->setName(substr(strrchr($image, "/"), 1).'.'.$ext);
        }
    }

    public function removeImage($image)
    {
        $parameterValue = $this->imagesDirectory;
        $file = new Filesystem();

        $file->remove($parameterValue.'/'.$image->getName());

    }

}