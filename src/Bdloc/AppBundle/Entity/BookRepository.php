<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository
{


	// select les 10 derniers livres
	public function selectTheLast10Books()
	{
		$query = $this->getEntityManager()->createQueryBuilder()
			->select('b')
			->from('BdlocAppBundle:Book', 'b')
			->setMaxResults(10)
			->getQuery();

		$books = $query->getResult();

		return $books;
	}







	// select les livre en fonction du titre du livre
	public function selectBooksByTitle($title)
	{

		$query = $this->getEntityManager()->createQueryBuilder()
			->select('b')
			->from('BdlocAppBundle:Book', 'b')
			->andWhere('b.title = :title')
			->setParameter('title', $title)
			->getQuery();

		$books = $query->getResult();

		return $books;
	}


}
