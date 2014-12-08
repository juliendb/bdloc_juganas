<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class BookRepository extends EntityRepository
{


	// select un livre par isbn
	public function selectBookByIsbn($isbn)
	{
		$query = $this->getEntityManager()->createQueryBuilder("b")
			->addSelect('b')
			->from('BdlocAppBundle:Book', 'b')
			->where('b.isbn = :isbn')
			->setParameter('isbn', $isbn)
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
