<?php

namespace Bdloc\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Bdloc\AppBundle\Entity\DeliveryPoints;



class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function homeAction()
    {
    	$params = array();

        return $this->render("default/home.html.twig", $params);
    }

}

