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





		/*
		public function sortCartItem()
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
		}*/



		// ajoute un livre au panier
		public function addCartItem($cart, $book)
		{

			$repoCartItem = $this->doctrine->getRepository("BdlocAppBundle:CartItem");
			$cartitems = $repoCartItem->selectAllCartItem($cart);


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
			
			}
			
		}



		public function gestion($isbn, $id, $action)
		{
			$params = array();


			$repoBook = $this->doctrine->getRepository("BdlocAppBundle:Book");
	        $repoUser = $this->doctrine->getRepository("BdlocAppBundle:User");
	        $repoCart = $this->doctrine->getRepository("BdlocAppBundle:Cart");

	        
	        $user = $repoUser->find($id);
	        $book = $repoBook->selectBookByIsbn($isbn);
			$cart = $repoCart->selectCartUser($user);
			

	        if ($action == "adding")
	        {

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


	 	       $this->addCartItem($cart, $book);
			}


			if ($action == "delete")
			{

			}



			return $params;
		}
	



	}


