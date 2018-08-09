<?php
/**
 * This file supports images actions
 * @category Service
 * @Package Virtua_Internship
 * @copyright Copyright (c) 2018 Virtua (http://www.wearevirtua.com)
 * @author Maciej Skalny contact@wearevirtua.com
 */

namespace App\Service;

use App\Entity\Image;
use App\Entity\ProductCategory;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImagesCollection
{
    /**
     * @var
     */
    private $imagesDirectory;

    /**
     * ImagesCollection constructor.
     * @param $imagesDirectory
     */
    public function __construct($imagesDirectory)
    {
        $this->imagesDirectory = $imagesDirectory;
    }

    /**
     * @param $image
     * @return Image
     */
    public function createImage(UploadedFile $image)
    {
        dump($image);
        $parameterValue = $this->imagesDirectory;

        $file = new Image();

        $ext = $image->guessExtension();
        $file->setName($image.'.'.$ext);

        $image->move(
            $parameterValue,
            $file->getName()
        );

        $file->setName(substr(strrchr($image, "/"), 1).'.'.$ext);

        return $file;
    }

//    /**
//     * @param $ProductCategory
//     * @param $images
//     */
//    public function addingImagesCollection($productCategory, $images){
//
//        $parameterValue = $this->imagesDirectory;
//
//        foreach($images as $image)
//        {
//
//            $file = new Image();
//            $ext = $image->guessExtension();
//            $file->setName($image.".".$ext);
//
//            $productCategory->addImage($file);
//
//            $image->move(
//                $parameterValue,
//                $file->getName()
//            );
//
//            $file->setName(substr(strrchr($image, "/"), 1).'.'.$ext);
//        }
//    }
//
//    /**
//     * @param $ProductCategory
//     * @param $mainImage
//     */
//    public function addingMainImage($productCategory, $mainImage)
//    {
//        $parameterValue = $this->imagesDirectory;
//
//        $ext = $mainImage->guessExtension();
//        $mainImageName = $mainImage.'.'.$ext;
//        $productCategory->setMainImage($mainImage . '.' .$ext);
//
//        $mainImage->move(
//            $parameterValue,
//            $mainImageName
//        );
//
//        $productCategory->setMainImage(substr(strrchr($mainImage, "/"), 1) . '.' . $ext);
//
//        $file = new Image();
//        $file->setName(substr(strrchr($mainImage, "/"), 1) . '.' . $ext);
//        //$productCategory->addImage($file);
//    }
}
