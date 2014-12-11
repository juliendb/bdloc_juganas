<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Bdloc\AppBundle\Entity\User;
use Bdloc\AppBundle\Util\StringHelper;
use Bdloc\AppBundle\Form\RegisterType;

class ProfilController extends Controller
{
    /**
     * @Route("/account/{id}")
     */
    public function accountAction($id)
    {
              
        $profilInfo = $this->getDoctrine()->getRepository("BdlocAppBundle:User");
        $user = $profilInfo->find($id);

        $params = array(
            "user" => $user
        );

        return $this->render("profil/compte.html.twig", $params);

    }

    /**
     * @Route("/account/{id}/edit")
     */
    public function editProfilAction($id)
    {
            
        //recupere la bdd user et l'id à stocker dans l'url  
        $editProfil = $this->getDoctrine()->getRepository("BdlocAppBundle:User");
        $user = $editProfil->find($id);
        $params = array(
            "user" => $user
        );

        //créer le formulaire
        $editForm = $this->createForm(new RegisterType(), $user);

        //prerempli le formulaire avec les données user
        $user = $this->getUser();

        //gère la soumission du form
        $request = $this->getRequest();
        $editForm->handleRequest($request);



        if ($editForm->isValid()){

            //sauvegarde le user en base
            $em = $this->getDoctrine()->getManager();
            $em->persist( $user );
            $em->flush();


            //redirige vers l'accueil
            return $this->redirect( $this->generateUrl( "bdloc_app_default_home" ) );
        }

        //afficher le formulaire
        $params['editForm'] = $editForm->createView();              
        return $this->render("profil/edit.html.twig", $params);

    }



}
