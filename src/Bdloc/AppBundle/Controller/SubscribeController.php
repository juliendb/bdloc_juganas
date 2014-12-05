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


class SubscribeController extends Controller
{
    /**
     * @Route("/step-1")
     */
    public function registerStep1Action()
    {

        $params = array();

        $user = new User();

        $registerForm = $this->createForm(new RegisterType(), $user);

        //gère la soumission du form
        $request = $this->getRequest();
        $registerForm->handleRequest($request);

        if ($registerForm->isValid()){

            //on termine l'hydratation de notre objet User
            //avant enregistrement

            $user->setCity("paris");
            $user->setDateCreated(new \DateTime());
            $user->setDateModified(new \DateTime());

            //salt, token, password hashé
            //dates directement dans l'entité avec les lifesyclecallbacks
           // $user->setRoles( array('ROLE_USER') );
            $stringHelper = new stringHelper();

            //hash le mot de passe(tiré de la doc)
            //toujours donner un salt 
            $user->setSalt( $stringHelper->randomString() );
            $user->setToken( $stringHelper->randomString(30) );

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);


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


            //redirige vers l'accueil
            return $this->redirect( $this->generateUrl("bdloc_app_subscribe_deliverystep2", array(
                'id' => $user->getId()
            )));
        }


        $params['registerForm'] = $registerForm->createView();
        
        
        return $this->render("subscription/step_1.html.twig", $params);
    }

    /**
     * @Route("/step-2/{id}")
     */
    public function deliveryStep2Action($id)
    {
        
        $params = array();

        //recuperer les coordonnées dans la bdd
        $repoCoordUser = $this->getDoctrine()->getRepository("BdlocAppBundle:User");
        $user = $repoCoordUser->find($id);

        //affichage de la google map
        $map = $this->get('ivory_google_map.map');

        $map = new Map();

        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map_canvas');

        $map->setAsync(true);
        $map->setAutoZoom(false);

        //centrer la map sur les coordonnées du user
        $map->setCenter($user->getLongitude(), $user->getLatitude(), true);
        //$map->setCenter(48.8788866, 2.331609599999979, true);
        $map->setMapOption('zoom', 17);

        //$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
        $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
        $map->setMapOption('mapTypeId', 'roadmap');

        $map->setMapOption('disableDefaultUI', true);
        $map->setMapOption('disableDoubleClickZoom', true);
        $map->setMapOptions(array(
            'disableDefaultUI'       => true,
            'disableDoubleClickZoom' => true,
        ));

        $map->setStylesheetOption('width', '600px');
        $map->setStylesheetOption('height', '400px');

        $map->setLanguage('fr');


        //les afficher sur la map (marker)
        $marker = new Marker();

        // Configure your marker options
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition($user->getLongitude(), $user->getLatitude(), true);
        $marker->setAnimation(Animation::DROP);

        $marker->setOptions(array(
            'clickable' => true,
            'flat'      => true,
        ));

        $marker->setIcon('http://maps.gstatic.com/mapfiles/markers/marker.png');
        $map->addMarker($marker);


        //recup l'id du user 
        $params['idUser'] = $id;
        //affichage de la map 
        $params["map"] = $map;
        //afficher le marker
        $params['marker'] = $marker;

        return $this->render("subscription/step_2.html.twig", $params);



    }

    /**
     * @Route("/step-3/{id}")
     */
    public function billingStep3Action($id)
    {
        $params = array();

        /*//recuperer les coordonnées dans la bdd
        $repoIdUser = $this->getDoctrine()->getRepository("BdlocAppBundle:User");
        $user = $repoIdUser->find($id);*/


        $params['idUser'] = $id;
        return $this->render("subscription/step_3.html.twig", $params);
    }


}
