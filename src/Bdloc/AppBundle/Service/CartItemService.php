<?php
	
	namespace Bdloc\AppBundle\Service;


	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\RequestStack;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

	use Bdloc\AppBundle\Entity\Book;
	use Bdloc\AppBundle\EntitySerie;
	use Bdloc\AppBundle\Entity\Author;

	use Bdloc\AppBundle\Entity\Cart;
	use Bdloc\AppBundle\Entity\CartItem;





	class CartItemService extends Controller
	{


		protected $requestStack;
		protected $doctrine;

		public function __construct(RequestStack $requestStack, $doctrine) {
			$this->requestStack = $requestStack;
			$this->doctrine = $doctrine;
		}




		public function isValid($params)
		{
			extract($params);


			$count = count($cartitems);

			if ($count < 10) {
				return true;
			}

			if ($book->getIsbn() == 1) {
				return true;
			}

			return false;
		}


		public function addCartItem($params)
		{
			extract($params);


			$repoCartItem = $this->doctrine->getRepository("BdlocAppBundle:CartItem");
			$cartitems = $repoCartItem->selectAllCartItem($cart);

			$params["cartitems"] = $cartitems;


			if ($this->isValid($params)) 
			{
				$cartitem = new CartItem();

				$cartitem->setDateCreated(new \DateTime());
	            $cartitem->setDateModified(new \DateTime());
	            $cartitem->setCart( $cart );
	            $cartitem->setBook( $book );

	            $em = $this->doctrine->getManager();
	            $em->persist($cartitem);
	            $em->flush();
			}
			
		}



		public function gestion($params)
		{
			extract($params);

			$repoBook = $this->doctrine->getRepository("BdlocAppBundle:Book");
	        $repoUser = $this->doctrine->getRepository("BdlocAppBundle:User");
	        $repoCart = $this->doctrine->getRepository("BdlocAppBundle:Cart");
	        
	        $user = $repoUser->find($id);
	        $book = $repoBook->selectBookByIsbn($isbn);


	        $params = array();
	        $params["book"] = $book;



	        // a mettre plus tard en service
	        if ($cart = $repoCart->selectCartUser())
	        {
	            $params["cart"] = $cart;
	            $this->addCartItem($params);

	        } else {
	            
	            $cart = new Cart();

	            $cart->setDateCreated(new \DateTime());
	            $cart->setDateModified(new \DateTime());
	            $cart->setStatus("active");
	            $cart->setUser($user);


	            $em = $this->getDoctrine()->getManager();
	            $em->persist($cart);
	            $em->flush();


	            $params["cart"] = $cart;
	            $this->addCartItem($params);
	        }


			return $params;
		}
	



	}


