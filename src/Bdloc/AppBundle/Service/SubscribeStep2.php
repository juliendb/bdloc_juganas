<?php
	
	namespace Bdloc\AppBundle\Service;


	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\RequestStack;
	use Symfony\Component\Security\Core\SecurityContextInterface;
	use Symfony\Component\HttpFoundation\Response;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

	use Bdloc\AppBundle\Entity\User;
	use Bdloc\AppBundle\Util\StringHelper;
	use Bdloc\AppBundle\Form\RegisterType;
	use Symfony\Component\Form\Forms;

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


	//templating->render()

	class SubscribeStep2 extends Controller
	{


		protected $requestStack;
		protected $doctrine;
		protected $formfactory;
		protected $templating;

		public function __construct(RequestStack $requestStack, $doctrine, $formfactory, $templating)
		{
			$this->requestStack = $requestStack;
			$this->doctrine = $doctrine;
			$this->formfactory = $formfactory;
			$this->templating = $templating;
		}



		public function getMap($user)
		{
			//AFFICHER LA GOOGLE MAP

			$map = new Map();

			$map->setPrefixJavascriptVariable('map_');
			$map->setHtmlContainerId('map_canvas');

			$map->setAsync(true);
			$map->setAutoZoom(false);

			//AFFICHER LE MARKER DE L'ADRESSE DU USER
			$map->setCenter($user->getLongitude(), $user->getLatitude(), true);
			//$map->setCenter(48.8788866, 2.331609599999979, true);
			$map->setMapOption('zoom', 15);

			//$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
			$map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
			$map->setMapOption('mapTypeId', 'roadmap');

			$map->setMapOption('disableDefaultUI', true);
			$map->setMapOption('disableDoubleClickZoom', true);
			$map->setMapOptions(array(
			    'disableDefaultUI'       => true,
			    'disableDoubleClickZoom' => true,
			));

			$map->setStylesheetOption('width', '700px');
			$map->setStylesheetOption('height', '400px');

			$map->setLanguage('fr');


			return $map;
		}



		private function createMarker($position, $icon, $urlabsolute = false)
		{
			$marker = new Marker();

			// Configure your marker options
			$marker->setPrefixJavascriptVariable('marker_');
			$marker->setPosition($position["longitude"], $position["latitude"], true);
			$marker->setAnimation(Animation::DROP);

			$marker->setOptions(array(
				'clickable' => true,
				'flat'      => true,
			));

			//recupere l'url relative
			$request = $this->requestStack->getCurrentRequest();
			$baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
			
			
			if (!$urlabsolute) {
				$marker->setIcon($baseurl . $icon);
			} else {
				$marker->setIcon($icon);
			}




			return $marker;
		}


		public function getMarkers($map, $user)
		{
			
			//AFFICHER LES MARKER POINTS RELAIS
			$position = array(
				"longitude" => $user->getLongitude(), 
				"latitude" => $user->getLatitude()
			);

			$marker = $this->createMarker($position, "/img/marker-icon.png");
			$map->addMarker($marker);

			
			//affichage des points relais
			$deliveryPoints = array();
			$deliveryPoints = $this->doctrine->getRepository("BdlocAppBundle:DeliveryPoints");
			$dPoints = $deliveryPoints->findAll();

			//print_r($dPoints);
			$markerCluster = $map->getMarkerCluster();


			// Configure markers
			for($i = 0; $i<count($dPoints); $i++) 
			{

				$position = array(
					"longitude" => $dPoints[$i]->getLongitude(), 
					"latitude" => $dPoints[$i]->getLatitude()
				);
				
				// marker points relais mettre un "true" si vous mettre une url http
				$marker = $this->createMarker($position, "http://maps.gstatic.com/mapfiles/markers/marker.png", true);


				// affiche multiple markers
				$markerCluster->addMarker($marker);


				//AFFICHER LES BULLES INFOS SUR LES MARKER POINTS RELAIS
				$infoWindow = new InfoWindow();

				$dataContent = array();
				$dataContent['pointRelais'] = $dPoints[$i];

				$content = $this->templating->render('subscription/infoBulle.html.twig', $dataContent);

				$infoWindow->setPrefixJavascriptVariable('info_window_');
				$infoWindow->setPosition($position["longitude"], $position["latitude"], true);
				$infoWindow->setPixelOffset(1.1, 2.1, 'px', 'pt');
				$infoWindow->setContent($content);
				$infoWindow->setOpen(false);
				$infoWindow->setAutoOpen(true);
				$infoWindow->setOpenEvent(MouseEvent::CLICK);
				$infoWindow->setAutoClose(true);
				$infoWindow->setOption('disableAutoPan', true);
				$infoWindow->setOption('zIndex', 10);
				$infoWindow->setOptions(array(
				    'disableAutoPan' => true,
				    'zIndex'         => 10,
				));

				$marker->setInfoWindow($infoWindow);
			}

			
			//lier les markers à la map
			$map->setMarkerCluster($markerCluster);

			return $map;
		}


	
		public function gestion($user, $mapService)
		{

			//recuperer les coordonnées dans la bdd
	        $repoUser = $this->doctrine->getRepository("BdlocAppBundle:User");
	        $repoDelivery = $this->doctrine->getRepository("BdlocAppBundle:DeliveryPoints");


			$map = $this->getMap($user, $mapService);
			$map = $this->getMarkers($map, $user);
			


			$params = array();

			if ( !empty($user->getMydelivery()) ) {
				$params["mydelivery"] = $user->getMydelivery();
			}

    

			//gère la soumission du form
			$request = $this->requestStack->getCurrentRequest();

			if ($request->getMethod() == "POST")
			{
				$delivery_id = $request->request->get('pointRelaisId');
				$mydelivery = $repoDelivery->find($delivery_id);


				$user->setMydelivery($mydelivery);

				$em = $this->doctrine->getManager();
				$em->persist($user);
				$em->flush();


				$params["mydelivery"] = $mydelivery;

			}


			//affichage de la map 
			$params["map"] = $map;
			//$params["delivery_id"] = $delivery_id;


	       return $params;
		}


	}


