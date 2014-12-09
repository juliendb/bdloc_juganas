<?php

namespace Bdloc\AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Bdloc\AppBundle\Entity\Book;
use Bdloc\AppBundle\EntitySerie;
use Bdloc\AppBundle\Entity\Author;
use Bdloc\AppBundle\Entity\Cart;

use Bdloc\AppBundle\Service\CartItemService;





class CartController extends Controller
{


    
    /**
     * @Route("/panier/voir/{id}")
     */
    public function cartViewAction($id)
    {
    	$params = array();


        return $this->render("cart/view_cart.html.twig", $params);
    }


    /**
     * @Route("/panier/ajouter/{isbn}/{id}")
     */
    public function addCartItemAction($isbn, $id)
    {
        $params = array();

        $params["isbn"] = $isbn;
        $params["id"] = $id;

        $cartitem = $this->get("bd.cartitemservice");
        $params = $cartitem->gestion($params);
        



        return $this->render("cart/add_cart.html.twig", $params);
    }
}
