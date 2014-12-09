<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class CartItemRepository extends EntityRepository
{



	// select cart utilisateur
	public function selectAllCartItem($params)
	{
		$query = $this
			->createQueryBuilder("ci")
			->join("ci.cart", "c")
			->addSelect("ci, c")
			->getQuery();

		$cart = $query->getResult();

		return $cart;
	}


}
