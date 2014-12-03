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
     * @Route("/catalogue/{page}", defaults={"page"=1})
     */
    public function catalogueAllAction($page = 1)
    {
    	$params = array();


    	$repoBook = $this->getDoctrine()->getRepository("BdlocAppBundle:Book");


        $pagination["page"] = $page;
        $pagination["limit"] = 5;
        $pagination["order"] = "ASC";
        $pagination['author'] = "Rosinski";
        
        $books = $repoBook->selectBooksByPagination($pagination);

        // total nombre bd
        $pagination['pages'] = $books->count();
        $pagination['total'] = ceil($books->count() / $pagination["limit"]);


    	$params["books"] = $books;
        $params["pagination"] = $pagination;


        return $this->render("catalogue/catalogue.html.twig", $params);
    }



    /**
     * @Route("/catalogue/detail/{isbn}")
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
