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
     * @Route("/panier/voir")
     */
    public function cartViewAction()
    {
    	$params = array();
        $params["user"] = $this->getUser();


        $cartitem = $this->get("bd.cartitemservice");
        $params = $cartitem->gestion($params, "display");


        return $this->render("cart/view_cart.html.twig", $params);
    }


    
    /**
     * @Route("/panier/retirer/{isbn}")
     */
    public function sortCartItemAction($isbn)
    {
        $params = array();
        $params["user"] = $this->getUser();
        $params["isbn"] = $isbn;

        $cartitem = $this->get("bd.cartitemservice");
        $params = $cartitem->gestion($params, "sorting");
        

        return $this->render("cart/sort_cart.html.twig", $params);
    }



    /**
     * @Route("/panier/ajouter/{isbn}")
     */
    public function addCartItemAction($isbn)
    {
        $params = array();
        $params["user"] = $this->getUser();
        $params["isbn"] = $isbn;

        $cartitem = $this->get("bd.cartitemservice");
        $params = $cartitem->gestion($params, "adding");
        

        return $this->render("cart/add_cart.html.twig", $params);
    }
}
