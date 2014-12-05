<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

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




	// select un livre par isbn
	public function selectBookByIsbn($isbn)
	{
		$query = $this->getEntityManager()->createQueryBuilder()
			->select('b')
			->from('BdlocAppBundle:Book', 'b')
			->where('b.isbn = :isbn')
			->setParameter('isbn', $isbn)
			->getQuery();

		$book = $query->getSingleResult();

		return $book;
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



	// select les livre en fonction de l'auteur
	public function selectBooksByAuthor($author)
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$query = $qb
			->select('b')
			->from('BdlocAppBundle:Book', 'b')
			->join("b.illustrator", "i")
			->join("b.scenarist", "s")
			->join("b.colorist", "c")
			->andWhere(
				$qb->expr()->orX
				(
					'i.lastName = :author',
					's.lastName = :author',
					'c.lastName = :author'
				)
			)
			->setParameter('author', $author)
			->getQuery();

		$books = $query->getResult();

		return $books;
	}




	// catégories
	public function selectCategories()
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$query = $qb
			->select('s')
			->from('BdlocAppBundle:Serie', 's')
			->groupBy('s.style')
			->getQuery();

		$books = $query->getResult();

		return $books;
	}






	// pagination avec select and co

	// select les livre en fonction de titre
	public function selectBookOrderTitle($date)
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$query = $qb
			->select('b')
			->from('BdlocAppBundle:Book', 'b')
			->setParameter('date', $date)
			->orderBy('b.title', 'ASC')
			->getQuery()
		;

		$books = $query->getResult();

		return $books;
	}



	// pagination
	public function selectBooksByPagination($params)
	{
		if ( !is_numeric($params["page"]) ) die("je suis une erreur");
		if ( !is_numeric($params["limit"]) ) die("je suis un raté");

		$results = ($params["page"]-1)* $params["limit"];


		$query = $this->getEntityManager()->createQueryBuilder();
		$query
			->select('b')
			->from('BdlocAppBundle:Book', 'b');


		// auteur
		if ( !empty($params['author']) )
		{
			$query
				->join("b.illustrator", "il")
				->join("b.scenarist", "sc")
				->join("b.colorist", "co")
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
			->setFirstResult($results)
			->setMaxResults($params["limit"]);

		// order
		if ($params["order"] === "ASC") $query->orderBy('b.title', 'ASC');
		if ($params["order"] === "DESC") $query->orderBy('b.title', 'DESC');
		
		return new Paginator($query);
	}




}
