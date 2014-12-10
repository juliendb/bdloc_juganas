<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class CartItemRepository extends EntityRepository
{



	// select cart utilisateur
	public function selectAllCartItem($cart)
	{
		$query = $this
			->createQueryBuilder("ci")
			->join("ci.cart", "c")
			->join("ci.book", "b")
			->addSelect("ci, c, b")
			->andWhere("c.id = :id_cart")
			->andWhere("c.status = 'active'")
			->setParameter("id_cart", $cart->getId())
			->getQuery();

		$cart = $query->getResult();

		return $cart;
	}

	// a voir plus tard triple sécurité
	// select cart utilisateur
	public function selectCartItem($cart, $book)
	{
		$query = $this
			->createQueryBuilder("ci")
			->join("ci.cart", "c")
			->join("ci.book", "b")
			->addSelect("ci, c, b")
			->andWhere("c.id = :id_cart")
			->andWhere("b.id = :isbn_book")
			->andWhere("c.status = 'active'")
			->setParameters(array(
					"id_cart" => $cart->getId(),
					"isbn_book" => $book->getIsbn()
				)
			)
			->getQuery();

		$cartitem = $query->getOneOrNullResult();

		return $cartitem;
	}


}
