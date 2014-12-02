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
     * @Route("/catalogue/voir")
     */
    public function viewsAllAction()
    {
    	$params = array();


    	$repoBook = $this->getDoctrine()->getRepository("BdlocAppBundle:Book");
    	$books = $repoBook->selectBooksByAuthor("Jodorowsky");


    	$params["books"] = $books;


        return $this->render("catalogue/views_all.html.twig", $params);
    }
}
