<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction()
    {
    	$params = array();


/*    	$repository = $this->getDoctrine()
    		->getRepository('BdlocAppBundle:Book');

		$query = $repository->createQueryBuilder('b')
			->select('b')
			->setMaxResults(10)
            ->getQuery();

        $books = $query->getResult();*/


        return $this->render("default/home.html.twig", $params);
    }
}
