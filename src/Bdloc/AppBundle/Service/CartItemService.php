<?php
	
	namespace Bdloc\AppBundle\Service;


	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\RequestStack;
	use Symfony\Component\HttpFoundation\JsonResponse;

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




		private function isValid($cartitems, $book)
		{
			$count = count($cartitems);
			

			foreach ($cartitems as $cartitem) {
				if ($cartitem->getBook() == $book) {
					return false;
				}
			}

			if ($count < 10 && $book->getStock() >= 1) {
				return true;
			}

			return false;
		}





		private function changeStock($book, $action)
		{

			if ($action == "on stock") $book->setStock( $book->getStock()-1 );
			if ($action == "off stock") $book->setStock( $book->getStock()+1 );

			$book->setDateModified(new \DateTime());

			$em = $this->doctrine->getManager();
            $em->persist($book);
            $em->flush();
		}





		
		public function sortCartItem($user, $cart, $book, $repoCartItem)
		{
			$cartitems = $repoCartItem->selectAllCartItem($user, $cart);
			$cartitem = $repoCartItem->selectCartItem($user, $cart, $book);


			$params = "";

			if ( !empty($cartitem) )
			{
				$em = $this->doctrine->getManager();
				$em->remove($cartitem);
				$em->flush();

				$this->changeStock($book, "off stock");


				$params = array(
						"stock_book" => $book->getStock(),
						"count_cart" => count($cartitems)-1,
					);
			}

			return $params;
		}



		// ajoute un livre au panier
		public function addCartItem($user, $cart, $book, $repoCartItem)
		{
			$cartitems = $repoCartItem->selectAllCartItem($user, $cart);
			

			$params = "";

			if ($this->isValid($cartitems, $book)) 
			{
				$cartitem = new CartItem();

				$cartitem->setDateCreated(new \DateTime());
	            $cartitem->setDateModified(new \DateTime());
	            $cartitem->setCart( $cart );
	            $cartitem->setBook( $book );

	            $em = $this->doctrine->getManager();
	            $em->persist($cartitem);
	            $em->flush();


				$this->changeStock($book, "on stock");
				

				// parametres retour pour js
				$params = array(
						"stock_book" => $book->getStock(),
						"count_cart" => count($cartitems)+1,
					);
			}
			

			return $params;
		}



		public function gestion($action, $user, $id = "")
		{

			$repoBook = $this->doctrine->getRepository("BdlocAppBundle:Book");
	        $repoUser = $this->doctrine->getRepository("BdlocAppBundle:User");
	        $repoCart = $this->doctrine->getRepository("BdlocAppBundle:Cart");
	        $repoCartItem = $this->doctrine->getRepository("BdlocAppBundle:CartItem");

			$cart = $repoCart->selectCartUser($user);
			



			if ($action == "display")
			{
				if ( !empty($cart) )
		        {

		        	$cartitems = $repoCartItem->selectAllCartItem($user, $cart);


		        	$params = array();
		        	$params["cartitems"] = $cartitems;

		        }
			}




	        if ($action == "adding")
	        {
	        	$book = $repoBook->selectBookById($id);


				if (empty($cart))
		        {
		            $cart = new Cart();

		            $cart->setDateCreated(new \DateTime());
		            $cart->setDateModified(new \DateTime());
		            $cart->setStatus("active");
		            $cart->setUser($user);


		            $em = $this->doctrine->getManager();
		            $em->persist($cart);
		            $em->flush();
		        }


				$response = $this->addCartItem($user, $cart, $book, $repoCartItem);


				$params = array();
				$params["action"] = "adding";
				$params["id"] = $id;
				$params["response"] = $response;
			}


			if ($action == "sorting")
			{
	        	$book = $repoBook->selectBookById($id);


	        	$response = $this->sortCartItem($user, $cart, $book, $repoCartItem);


	        	$params = array();
	        	$params["action"] = "sorting";
	        	$params["id"] = $id;
	        	$params["response"] = $response;
			}



			return $params;
		}
	



	}


