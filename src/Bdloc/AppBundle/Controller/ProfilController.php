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
     * @Template()
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

}
