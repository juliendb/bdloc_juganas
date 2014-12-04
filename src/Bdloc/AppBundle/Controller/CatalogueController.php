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
        //$slugger = $this->get("bd.slugger");


    	$params = array();


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
