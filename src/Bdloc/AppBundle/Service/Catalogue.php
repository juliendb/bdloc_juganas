<?php
	
	namespace Bdloc\AppBundle\Service;


	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\RequestStack;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

	use Bdloc\AppBundle\Entity\Book;
	use Bdloc\AppBundle\EntitySerie;
	use Bdloc\AppBundle\Entity\Author;





	class Catalogue extends Controller
	{


		protected $requestStack;
		protected $doctrine;

		public function __construct(RequestStack $requestStack, $doctrine) {
			$this->requestStack = $requestStack;
			$this->doctrine = $doctrine;
		}



		public function redirection($params)
		{
			$params["redirect"] = true;
			return $params;
		}


		public function isValid($params)
		{
			if ( !is_numeric($params["page"]) ) return false;
			if ( !is_numeric($params["limit"]) ) return false;


			if ( $params["order"] != "ASC" && $params["order"] != "DESC" ) {
				return false;
			}


			if ( $params["choice"] != "title" && $params["choice"] != "serie" && $params["choice"] != "publisher" ) {
				return false;
			}


			return true;
		}



		public function pagination($params)
		{
			// vérifie si valeurs correctes
			if ( $this->isValid($params) ) $this->redirection($params);
			

			extract($params);


			$request = $this->requestStack->getCurrentRequest();

			$repoBook = $this->doctrine->getRepository("BdlocAppBundle:Book");
			$repoSerie = $this->doctrine->getRepository("BdlocAppBundle:Serie");
			




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
			if ($request->getMethod() == 'POST') $this->redirection($pagination);


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


