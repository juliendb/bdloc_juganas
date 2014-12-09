<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        $user = new User();

        $editForm = $this->createForm(new RegisterType(), $user);

        $params['editForm'] = $editForm->createView();
        
        return $this->render("profil/edit.html.twig", $params);

    }



}
