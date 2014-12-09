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




		private function isValid($params)
		{
			extract($params);


			$count = count($cartitems);

			if ($count < 10 && $book->getStock() >= 1) {
				return true;
			}

			return false;
		}



		private function changeStock($params)
		{
			extract($params);

			$val = 0;
			if ($stock = "en stock") $val = 1;
			if ($stock = "plus stock") $val = 0;



			$book->setStock($val);
			$book->setDateModified(new \DateTime());

			$em = $this->doctrine->getManager();
            $em->persist($book);
            $em->flush();
		}



		public function sortCartItem($params)
		{
			extract($params);


			$repoCartItem = $this->doctrine->getRepository("BdlocAppBundle:CartItem");
			$repoUser = $this->doctrine->getRepository("BdlocAppBundle:User");
			$repoBook = $this->doctrine->getRepository("BdlocAppBundle:Book");


			$user = $repoUser->find($id);
	        $book = $repoBook->selectBookByIsbn($isbn);


	        $params = array();
	        $params["book"] = $book;


			$params["stock"] = "plus stock";
			$this->changeStock($params);


			$em->remove($cartitem);
			$em->persist($cartitem);
			$em->flush();
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


	            $params["stock"] = "en stock";
	            $this->changeStock($params);
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
	        if (!$cart = $repoCart->selectCartUser())
	        {
	            
	            $cart = new Cart();

	            $cart->setDateCreated(new \DateTime());
	            $cart->setDateModified(new \DateTime());
	            $cart->setStatus("active");
	            $cart->setUser($user);


	            $em = $this->getDoctrine()->getManager();
	            $em->persist($cart);
	            $em->flush();
	        }


	        $params["cart"] = $cart;
	        $this->addCartItem($params);




			return $params;
		}
	



	}


