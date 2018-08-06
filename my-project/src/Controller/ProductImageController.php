<?php

namespace App\Controller;

use App\Entity\ProductImage;
use App\Entity\Product;
use App\Repository\ProductImageRepository;
use App\Service\ProductImagesCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * @Route("/product/image")
 */
class ProductImageController extends Controller
{
    /**
     * @Route("/{id}", name="product_image_delete", methods="DELETE")
     */
    public function delete(Request $request, ProductImage $productImage, ProductImagesCollection $productImagesCollection): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productImage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();

            $productImagesCollection->removeImage($productImage);
            $product = $productImage->getProduct();

            if($product->getMainImage() == $productImage->getName())
                $product->setMainImage(NULL);

            $em->remove($productImage);
            $em->flush();
        }

        return $this->redirectToRoute('product_edit', ['id' => $product->getId()]);
    }
}