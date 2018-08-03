<?php
/**
 * Created by PhpStorm.
 * User: virtua
 * Date: 03.08.2018
 * Time: 10:09
 */

namespace App\Service;

use App\Entity\Image;
use App\Entity\ProductCategory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class ImagesCollection
{

    private $imagesDirectory;

    public function __construct($imagesDirectory)
    {
        $this->imagesDirectory = $imagesDirectory;
    }
    public function addingImagesCollection($ProductCategory, $images){

        $parameterValue = $this->imagesDirectory;

        foreach($images as $image)
        {

            $file = new Image();
            $ext = $image->guessExtension();
            $file->setName($image.".".$image->guessExtension());

            $ProductCategory->addImage($file);

            $image->move(
                $parameterValue,
                $file->getName()
            );

            $file->setName(substr(strrchr($image, "/"), 1).'.'.$ext);
        }
    }
}
