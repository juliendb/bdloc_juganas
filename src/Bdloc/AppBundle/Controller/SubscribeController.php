<?php

namespace Bdloc\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Bdloc\AppBundle\Entity\User;
use Bdloc\AppBundle\Util\StringHelper;
use Bdloc\AppBundle\Form\RegisterType;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerCluster;
use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\InfoWindow;

use Bdloc\AppBundle\Service\SubscribeStep1;






class SubscribeController extends Controller
{
    /**
     * @Route("/step-1")
     */
    public function registerStep1Action()
    {

        $params = array();


        $subscribe = $this->get("bd.subscribestep1");
        $params = $subscribe->registerUser();


        $params['registerForm'] = $registerForm->createView();

        if ( !empty($params["redirection"]) ) 
        {
            return $this->redirect( $this->generateUrl($params["redirection"]["url"], 
                $params["redirection"]["parameters"]) );
        }
        
        
        return $this->render("subscription/step_1.html.twig", $params);
    }





    /**
     * @Route("/step-2/{id}")
     */
    public function registerStep2Action($id)
    {
        
        $params = array();

        //AFFICHER LA GOOGLE MAP
        $map = $this->get('ivory_google_map.map');
        
        $subscribe = $this->get("bd.subscribestep2");
        $params = $subscribe->gestion($id, $map);

        //recup l'id du user 
        $params['idUser'] = $id;


        return $this->render("subscription/step_2.html.twig", $params);
    }

    /**
     * @Route("/step-3/{id}")
     */
    public function registerStep3Action($id)
    {
        $params = array();

        /*//recuperer les coordonnées dans la bdd
        $repoIdUser = $this->getDoctrine()->getRepository("BdlocAppBundle:User");
        $user = $repoIdUser->find($id);*/


       // $params['delivery_id'] = $delivery_id;
        $params['idUser'] = $id;
        return $this->render("subscription/step_3.html.twig", $params);
    }

}
