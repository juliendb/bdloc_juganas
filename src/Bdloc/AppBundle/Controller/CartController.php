<?php

namespace Bdloc\AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $user = $this->getUser();


        $cartitem = $this->get("bd.cartitemservice");
        $params = $cartitem->gestion("display", $user);


        return $this->render("cart/view_cart.html.twig", $params);
    }


    
    /**
     * @Route("/panier/retirer/{id}")
     */
    public function sortCartItemAction($id)
    {
        $params = array();
        $user = $this->getUser();

        $cartitem = $this->get("bd.cartitemservice");
        $params = $cartitem->gestion("sorting", $user, $id);
        

		$response = new JsonResponse();
		$response->setData($params);

		return $response;
    }



    /**
     * @Route("/panier/ajouter/{id}")
     */
    public function addCartItemAction($id)
    {
        $params = array();
        $user = $this->getUser();

        $cartitem = $this->get("bd.cartitemservice");
        $params = $cartitem->gestion("adding", $user, $id);
        

        $response = new JsonResponse();
		$response->setData($params);

		return $response;
    }
}
