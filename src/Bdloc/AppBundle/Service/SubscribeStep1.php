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




	class SubscribeStep1 extends Controller
	{


		protected $requestStack;
		protected $doctrine;
		protected $formfactory;

		public function __construct(RequestStack $requestStack, $doctrine, $formfactory) {
			$this->requestStack = $requestStack;
			$this->doctrine = $doctrine;
			$this->formfactory = $formfactory;
		}


	
		public function registerUser()
		{
			$user = new User();
			$stringHelper = new stringHelper();

			$registerForm = $this->formfactory->create(new RegisterType(), $user);



	        //gère la soumission du form
			$request = $this->requestStack->getCurrentRequest();
	        $registerForm->handleRequest($request);

	        if ($registerForm->isValid())
	        {

	            //on termine l'hydratation de notre objet User
	            //avant enregistrement

	            $user->setCity("paris");
	            $user->setDateCreated(new \DateTime());
	            $user->setDateModified(new \DateTime());

				//salt, token, password hashé
				//dates directement dans l'entité avec les lifesyclecallbacks
				// $user->setRoles( array('ROLE_USER') );


				//hash le mot de passe(tiré de la doc)
				//toujours donner un salt 
	            $user->setSalt( $stringHelper->randomString() );
	            $user->setToken( $stringHelper->randomString(30) );

	            $factory = $this->get('security.encoder_factory');
	            $encoder = $factory->getEncoder($user);
	            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
	            $user->setPassword($password);


	            //sauvegarde en bdd avec l'entity manager
	            $em = $this->doctrine->getManager();
	            //elle la sauvegarde en bdd en persistant
	            $em->persist($user);
	            //on excute toutes nos données
	            $em->flush();


	            //CONNEXION AUTOMATIQUE : src : http://stackoverflow.com/questions/9550079/how-to-programmatically-login-authenticate-a-user
	            //secured_area est le nom du firewall défini dans security.yml
	            $token = new UsernamePasswordToken($user, $user->getPassword(), "secured_area", $user->getRoles());
	            $this->get("security.context")->setToken($token);


	            //redirige vers l'accueil
	            $params = array();
	            $params["redirection"] = array(
	            		"url" => "bdloc_app_subscribe_registerstep2",
	            		"parameters" => array(
	            			"id" => $user->getId()
	            		)
	            	);

	            return $params;
	        }


	        $params = array();
	        $params['registerForm'] = $registerForm->createView();

	        return $params;
		}


	}


