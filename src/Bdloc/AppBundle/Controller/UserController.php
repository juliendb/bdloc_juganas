<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


/**
	*@Route("/connexion")
	*/
	public function loginAction(Resquest $request)
    {

    	$params = array();

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


        //sauvegarde en bdd avec l'entity manager
        $em = $this->getDoctrine()->getManager();
        //elle la sauvegarde en bdd en persistant
        $em->persist($user);
        //on excute toutes nos données
        $em->flush();

		
        //CONNEXION AUTOMATIQUE : src : http://stackoverflow.com/questions/9550079/how-to-programmatically-login-authenticate-a-user
        //secured_area est le nom du firewall défini dans security.yml
        $token = new UsernamePasswordToken($user, $user->getPassword(), "secured_area", $user->getRoles());
        $this->get("security.context")->setToken($token);

        //déclenche l'evenement de login
       // $event = new InteractiveLoginEvent($request, $token);
      //  $this->get("event_dispatcher")->dispatch("security.interactive_login",$event);

        //redirige vers l'accueil
        return $this->redirect( $this->generateUrl("bdloc_app_subscribe_deliverystep2"));

    }
}