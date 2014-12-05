<?php

namespace Bdloc\AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Bdloc\AppBundle\Entity\Book;
use Bdloc\AppBundle\EntitySerie;
use Bdloc\AppBundle\Entity\Author;





class CatalogueController extends Controller
{


    
    /**
     * @Route("/catalogue/{page}/{limit}/{order}", defaults={"page"=1,"limit"=20, "order"="ASC"})
     */
    public function catalogueAllAction($page, $limit, $order)
    {
    	$params = array();


        //$slugger = $this->get("bd.slugger");
        if ( !empty($_POST["category"]) )
        {
            $genres = $_POST["category"];
            $pagination["genres"] = $genres;

            $page = 1;
        }


        
        // select pagination
        if ( !empty($_POST["order_pages"]) ) $order = $_POST["order_pages"];
        if ( !empty($_POST["limit_pages"]) ) $limit = $_POST["limit_pages"];

        if ( !empty($_POST["order_pages"]) || !empty($_POST["limit_pages"]) )
        {
            $params["order"] = $order;
            $params["page"] = $page;
            $params["limit"] = $limit;

            $url = $this->generateUrl('bdloc_app_catalogue_catalogueall', $params);
            return $this->redirect($url);
        }



    	$repoBook = $this->getDoctrine()->getRepository("BdlocAppBundle:Book");


        $pagination["page"] = $page;
        $pagination["limit"] = $limit;
        $pagination["order"] = $order;
        //$pagination['author'] = "Rosinski";

        $books = $repoBook->selectBooksByPagination($pagination);
        $categories = $repoBook->selectCategories();

        // total nombre bd
        $pagination['total'] = $books->count();
        $pagination['pages'] = ceil($pagination['total'] / $pagination["limit"]);


    	$params["books"] = $books;
        $params["pagination"] = $pagination;
        $params["categories"] = $categories;


        return $this->render("catalogue/catalogue.html.twig", $params);
    }



    /**
     * @Route("/livre/detail/{isbn}")
     */
    public function viewBookAction($isbn)
    {
        //2878271734 tome 6
        //9782878271737 tome 7

        $params = array();

        
        $repoBook = $this->getDoctrine()->getRepository("BdlocAppBundle:Book");
        $book = $repoBook->selectBookByIsbn($isbn);


        $params["book"] = $book;
        
        return $this->render("catalogue/view_book.html.twig", $params);
    }
}
