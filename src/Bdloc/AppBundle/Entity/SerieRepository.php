<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SerieRepository extends EntityRepository
{




	// catégories
	public function selectGenres()
	{
		$query = $this
			->createQueryBuilder("s")
			->groupBy('s.style')
			->addSelect('s')
			->getQuery();

		$genres = $query->getResult();

		return $genres;
	}

}
