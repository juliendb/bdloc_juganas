<?php

namespace Bdloc\AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Bdloc\AppBundle\Entity\Book;
use Bdloc\AppBundle\EntitySerie;
use Bdloc\AppBundle\Entity\Author;
use Bdloc\AppBundle\Service\Catalogue;





class CatalogueController extends Controller
{


    
    /**
     * @Route("/catalogue/{page}/{limit}/{choice}/{order}/{genres}", defaults={"page"=1,"limit"=20,"choice"="title","order"="ASC","genres"=""})
     */
    public function catalogueAllAction($page, $limit, $choice, $order, $genres)
    {
    	$params = array();
    	$request = Request::createFromGlobals();

    	$repoBook = $this->getDoctrine()->getRepository("BdlocAppBundle:Book");
		$repoSerie = $this->getDoctrine()->getRepository("BdlocAppBundle:Serie");


		$params["page"] = $page;
		$params["limit"] = $limit;
		$params["choice"] = $choice;
		$params["order"] = $order;
		$params["genres"] = $genres;

		$params["request"] = $request;
		$params["repoBook"] = $repoBook;
		$params["repoSerie"] = $repoSerie;


		$catalogue = $this->get("bd.catalogue");
		$params = $catalogue->pagination($params);


        return $this->render("catalogue/catalogue.html.twig", $params);
    }



    /**
     * @Route("/livre/detail/{isbn}")
     */
    public function viewBookAction($isbn)
    {
        $params = array();

        
        $repoBook = $this->getDoctrine()->getRepository("BdlocAppBundle:Book");
        $book = $repoBook->selectBookByIsbn($isbn);


        $params["book"] = $book;
        
        return $this->render("catalogue/view_book.html.twig", $params);
    }
}
