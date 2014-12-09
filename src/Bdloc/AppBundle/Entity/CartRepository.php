<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class CartRepository extends EntityRepository
{



	// select cart utilisateur
	public function selectCartUser()
	{
		$query = $this
			->createQueryBuilder("c")
			->where("c.status = 'active'")
			->addSelect("c")
			->getQuery();

		$cart = $query->getOneOrNullResult();

		return $cart;
	}	


}
