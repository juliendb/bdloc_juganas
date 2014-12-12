<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class CartItemRepository extends EntityRepository
{



	// select cart utilisateur
	public function selectAllCartItem($user, $cart)
	{
		$params = array(
			"id_cart" => $cart->getId(),
			"id_user" => $user->getId(),
		);

		$query = $this
			->createQueryBuilder("ci")
			->join("ci.cart", "c")
			->join("ci.book", "b")
			->join("c.user", "u")
			->addSelect("ci, c, b, u")
			->andWhere("c.id = :id_cart")
			->andWhere("u.id = :id_user")
			->andWhere("c.status = 'active'")
			->setParameters($params)
			->getQuery();

		$cart = $query->getResult();

		return $cart;
	}

	// a voir plus tard triple sécurité
	// select cart utilisateur
	public function selectCartItem($user, $cart, $book)
	{
		$params = array(
			"user" => $user->getId(),
			"id_cart" => $cart->getId(),
			"id_book" => $book->getId(),
		);


		$query = $this
			->createQueryBuilder("ci")
			->join("ci.cart", "c")
			->join("ci.book", "b")
			->join("c.user", "u")
			->addSelect("ci, c, b, u")
			->andWhere("c.id = :id_cart")
			->andWhere("b.id = :id_book")
			->andWhere("u.id = :user")
			->andWhere("c.status = 'active'")
			->setParameters($params)
			->getQuery();

		$cartitem = $query->getOneOrNullResult();

		return $cartitem;
	}



	// select cart utilisateur
	public function selectAllCartItemHistory($cart, $user)
	{
		$params = array(
			"id_user" => $user->getId(),
			"id_cart" => $cart->getId(),
		);


		$query = $this
			->createQueryBuilder("ci")
			->join("ci.cart", "c")
			->join("ci.book", "b")
			->join("c.user", "u")
			->addSelect("ci, c, b, u")
			->andWhere("c.id = :id_cart")
			->andWhere("u.id = :id_user")
			->setParameters($params)
			->groupBy("c.dateCreated")
			->getQuery();

		$cart = $query->getResult();

		return $cart;
	}

}
