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





	// select les livre en fonction de la série
	public function selectBooksBySerie($serie)
	{

		$query = $this->getEntityManager()->createQueryBuilder()
			->select('b')
			->from('BdlocAppBundle:Book', 'b')
			->join('b.serie', 's')
			->andWhere('s.title = :serie')
			->setParameter('serie', $serie)
			->getQuery();

		$books = $query->getResult();

		return $books;
	}



	// select les livre en fonction de la série
	public function selectBooksBySerie($serie)
	{

		$query = $this->getEntityManager()->createQueryBuilder()
			->select('b')
			->from('BdlocAppBundle:Book', 'b')
			->join('b.serie', 's')
			->andWhere('s.title = :serie')
			->setParameter('serie', $serie)
			->getQuery();

		$books = $query->getResult();

		return $books;
	}

}
