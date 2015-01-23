<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ProductController
 * @package AppBundle\Controller
 *
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="product_list")
     * @Template("AppBundle:product/list:base.html.twig")
     */
    public function listAction()
    {
        $products = $this->getRepository()->findAll();

        return array(
            'products' => $products,
        );
    }

    /**
     * @Route("/show/{product}", name="product_show")
     * @Template("AppBundle:product/show:base.html.twig")
     * @ParamConverter("product", class="AppBundle:Product", options={"repository_method" = "findOneBySlug"})
     */
    public function showAction(Product $product)
    {
        return array(
            'product' => $product,
        );
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Product');
    }
}
