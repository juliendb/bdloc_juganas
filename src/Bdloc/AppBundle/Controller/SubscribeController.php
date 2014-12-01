<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SubscribeController extends Controller
{
    /**
     * @Route("/step-1")
     */
    public function registerStep1Action()
    {
    	$params = array();



        return $this->render("subscription/step_1.html.twig", $params);
    }

    /**
     * @Route("/step-2")
     */
    public function deliveryStep2Action()
    {
        $params = array();


        return $this->render("subscription/step_2.html.twig", $params);
    }

    /**
     * @Route("/step-3")
     */
    public function billingStep3Action()
    {
        $params = array();


        return $this->render("subscription/step_3.html.twig", $params);
    }


}
