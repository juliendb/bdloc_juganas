<?php

namespace Bdloc\AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcher;

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



		$params["page"] = $page;
		$params["limit"] = $limit;
		$params["choice"] = $choice;
		$params["order"] = $order;
		$params["genres"] = $genres;

        
		$catalogue = $this->get("bd.catalogue");
		$params = $catalogue->pagination($params);

        if ( !empty($params["redirection"]) )
        {
            $url = $this->generateUrl('bdloc_app_catalogue_catalogueall', $params);
            return $this->redirect($url);
        }


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
