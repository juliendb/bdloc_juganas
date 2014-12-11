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
		protected $encoder_factory;
		protected $security_context;

		public function __construct(RequestStack $requestStack, $doctrine, $formfactory, $encoder_factory, $security_context) {
			$this->requestStack = $requestStack;
			$this->doctrine = $doctrine;
			$this->formfactory = $formfactory;
			$this->encoder_factory = $encoder_factory;
			$this->security_context = $security_context;
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

	            

	            $encoder = $this->encoder_factory->getEncoder($user);
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
	            $this->security_context->setToken($token);


	            //redirige vers l'accueil
	            $params = array();
	            $params["redirection"] = "bdloc_app_subscribe_registerstep2";

	            return $params;
	        }


	        $params = array();
	        $params['registerForm'] = $registerForm->createView();

	        return $params;
		}


	}


