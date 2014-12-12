<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class BookRepository extends EntityRepository
{


	// select un livre par id
	public function selectBookById($id)
	{
		$query = $this
			->createQueryBuilder("b")
			->addSelect('b')
			->where('b.id = :id')
			->setParameter('id', $id)
			->getQuery();

		$book = $query->getSingleResult();

		return $book;
	}







	// pagination
	public function selectBooksByPagination($params)
	{
		$query = $this
			->createQueryBuilder("b")
			->join("b.illustrator", "il")
			->join("b.scenarist", "sc")
			->join("b.colorist", "co")
			->join("b.serie", "s")
			->addSelect("il,sc,co,s,b");

		


		// genres
		if ( !empty($params['genres']) )
		{
			for($i=0; $i<count($params['genres']); $i++)
			{
				$query
					->orWhere('s.style = :genre'.$i)
					->setParameter('genre'.$i, $params['genres'][$i]);
			}
		}


		// availability
		if ( !empty($params['availability']) )
		{
			if ($params['availability'] == "available") $query->andWhere('b.stock > 0');
			if ($params['availability'] == "noneavailable") $query->andWhere('b.stock = 0');
		}


		// serie
		if ( !empty($params['serie']) )
		{
			$query
				->andWhere('s.title = :serie')
				->setParameter('serie', $params['serie']);
		}


		// auteur
		if ( !empty($params['author']) )
		{
			$query
				->andWhere(
					$query->expr()->orX
					(
						'il.lastName = :author',
						'sc.lastName = :author',
						'co.lastName = :author'
					)
				)

				->setParameter('author', $params['author']);
		}


		$query
			->setFirstResult($params["first"])
			->setMaxResults($params["limit"]);


		// order
		if ($params['choice'] == "title") $query->addOrderBy('b.title', $params['order']);
		if ($params['choice'] == "serie") $query->addOrderBy('s.title', $params['order']);
		if ($params['choice'] == "publisher") $query->addOrderBy('b.publisher', $params['order']);
		


		return new Paginator($query);
	}


}
