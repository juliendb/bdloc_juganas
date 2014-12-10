<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class CartRepository extends EntityRepository
{



	// select cart utilisateur
	public function selectCartUser($user)
	{
		$query = $this
			->createQueryBuilder("c")
			->join("c.user", "u")
			->addSelect("c,u")
			->andWhere("u.id = :user_id")
			->andWhere("c.status = 'active'")
			->setParameter('user_id', $user->getId())
			->getQuery();

		$cart = $query->getOneOrNullResult();

		return $cart;
	}	


}
