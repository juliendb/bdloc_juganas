<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Bdloc\AppBundle\Form\RegisterType;
use Bdloc\AppBundle\Entity\User;


class UserController extends Controller{

    /**
    * @Route("/connexion")
    */
	public function loginAction(Request $request)
    {

    	$params = array();
        $user = new User();

        $registerForm = $this->createForm(new RegisterType(), $user);

        //gère la soumission du form
        $request = $this->getRequest();
        $session = $request->getSession();



        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render('layouts/login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));


      
    }
}