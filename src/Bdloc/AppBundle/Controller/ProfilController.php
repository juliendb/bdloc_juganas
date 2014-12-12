<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Bdloc\AppBundle\Entity\User;
use Bdloc\AppBundle\Util\StringHelper;
use Bdloc\AppBundle\Form\EditProfilType;

use Bdloc\AppBundle\Entity\CartItem;
use Bdloc\AppBundle\Entity\Cart;


class ProfilController extends Controller
{
    /**
     * @Route("/account")
     */
    public function accountAction()
    {

        $repoCart = $this->getDoctrine()->getRepository("BdlocAppBundle:Cart");
        $repoCartItem = $this->getDoctrine()->getRepository("BdlocAppBundle:CartItem");

        // si tu es connecté tu utilise cette méthode (voir guillaume formateur)
        $user = $this->getUser();

        $params = array(
            "user" => $user
        );


        $history_carts = $repoCart->selectCartHistoryUser($user);
        //dump($history_carts);
        $params["carts"] = $history_carts;


        return $this->render("profil/compte.html.twig", $params);

    }

    /**
     * @Route("/account/edit")
     */
    public function editProfilAction()
    {
            
        //recupere la bdd user et l'id à stocker dans l'url  
        //$editProfil = $this->getDoctrine()->getRepository("BdlocAppBundle:User");
        
        // si tu es connecté tu utilise cette méthode (voir guillaume formateur)
        // a voir pour plus de sécurité
        $user = $this->getUser();

        $params = array(
            "user" => $user
        );

        //créer le formulaire
        $editProfilForm = $this->createForm(new EditProfilType(), $user);

        //prerempli le formulaire avec les données user
        $user = $this->getUser();

        //gère la soumission du form
        $request = $this->getRequest();
        $editProfilForm->handleRequest($request);



        if ($editProfilForm->isValid()){

            //sauvegarde le user en base
            $em = $this->getDoctrine()->getManager();
            $em->persist( $user );
            $em->flush();


            //redirige vers l'accueil
            //return $this->redirect( $this->generateUrl( "bdloc_app_default_home" ) );
        }


        //afficher le formulaire
        $params['editProfilForm'] = $editProfilForm->createView();              
        return $this->render("profil/edit.html.twig", $params);

    }




    /**
     * @Route("/account/desabonnement")
     */
    public function unsubsribeAction()
    {

    }


}
