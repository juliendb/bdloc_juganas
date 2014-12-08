<?php


	use Symfony\Component\HttpFoundation\Request;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

	use Bdloc\AppBundle\Entity\Book;
	use Bdloc\AppBundle\EntitySerie;
	use Bdloc\AppBundle\Entity\Author;


	namespace Bdloc\AppBundle\Service;



	class Catalogue
	{


		public function redirect($params)
		{
			$url = $this->generateUrl('bdloc_app_catalogue_catalogueall', $params);
			return $this->redirect($url);
		}


		public function isValid($params)
		{
			if ( !is_numeric($params["page"]) ) $this->redirect(array());
			if ( !is_numeric($params["limit"]) ) $this->redirect(array());


			if ( $params["order"] != "ASC" && $params["order"] != "DESC" ) {
				$this->redirect(array());
			}


			if ( $params["choice"] != "title" && $params["choice"] != "serie" && $params["choice"] != "publisher" ) {
				$this->redirect(array());
			}
		}



		public function pagination($params)
		{
			$this->isValid($params);


			$page = $params["page"];
			$limit = $params["limit"];
			$choice = $params["choice"];
			$order = $params["order"];
			$genres = $params["genres"];
			
			$request = $params["request"];
			$repoBook = $params["repoBook"];
			$repoSerie = $params["repoSerie"];
			


			$params = array();

			// si il y a un truc dans l'url on le transforme en array
			$url_genres = "";
			if ( !empty($genres) ) 
			{
				$url_genres = $genres;
				$genres = explode(",", $genres);
			}


			if ($request->getMethod() == 'POST')
			{
				$genres = $request->request->get('genres');
				$limit = $request->request->get('limit');
				$choice = $request->request->get('choice');
				$order = $request->request->get('order');

				if ( !empty($genres) )
				{
					foreach ($genres as $genre) $url_genres .= $genre.",";
					$url_genres = substr($url_genres, 0, -1);
				}


				$page = 1;
			}


			$pagination["page"] = $page;
			$pagination["limit"] = $limit;
			$pagination["order"] = $order;
			$pagination["choice"] = $choice;
			$pagination["genres"] = $url_genres;



			// redirect url si dans le post y a un truc
			if ($request->getMethod() == 'POST') $this->redirect($pagination);


			// calcul la ou commence la pagination
			$first = ($page-1)* $limit;
			$pagination["first"] = $first;
			$pagination["genres"] = $genres;
			$pagination["url_genres"] = $url_genres;
			//$pagination['serie'] = "Thorgal";
			//$pagination['author'] = "Rosinski";


			$books = $repoBook->selectBooksByPagination($pagination);
			$genres = $repoSerie->selectGenres();

			// total nombre bd
			$pagination['total'] = $books->count();
			$pagination['pages'] = ceil($pagination['total'] / $pagination["limit"]);


			$params["books"] = $books;
			$params["pagination"] = $pagination;
			$params["genres"] = $genres;


			return $params;
		}
	



	}


