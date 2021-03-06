<?php

namespace Bdloc\AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

// NE PAS OUBLIER CETTE LIGNE
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @UniqueEntity("username", message="Ce pseudo est déjà utilisé !", groups={"registration"})
 * @UniqueEntity("email", message="Vous avez déjà un compte ici !", groups={"registration"})
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Bdloc\AppBundle\Entity\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255)
     */
    private $adress;

    /**
     * @var integer
     *
     * @ORM\Column(name="postalCode", type="string", length=255, nullable = true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable = true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable = true)
     */
    private $latitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable = true)
     */
    private $tel;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPaypal", type="smallint", nullable = true)
     */
    private $idPaypal;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModified", type="datetime")
     */
    private $dateModified;


   /**
    *
    * @ORM\OneToMany(targetEntity="CreditCard", mappedBy="user")
    */
    private $creditcards;



    /**
     *
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="user")
     * @ORM\JoinColumn(nullable = false)
     */
    private $carts;



    /**
     *
     * @ORM\ManyToOne(targetEntity="DeliveryPoints", inversedBy="user")
     */
    private $mydelivery;






    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = strip_tags($firstname);

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = strip_tags($name);

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->name;
    }


    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = strip_tags($email);

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = strip_tags($password);

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return User
     */
    public function setAdress($adress)
    {
        $this->adress = strip_tags($adress);

        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     * @return User
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = strip_tags($postalCode);

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return integer 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = strip_tags($city);

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = strip_tags($tel);

        return $this;
    }

    /**
     * Get tel
     *
     * @return integer 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set idPaypal
     *
     * @param integer $idPaypal
     * @return User
     */
    public function setIdPaypal($idPaypal)
    {
        $this->idPaypal = $idPaypal;

        return $this;
    }

    /**
     * Get idPaypal
     *
     * @return integer 
     */
    public function getIdPaypal()
    {
        return $this->idPaypal;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return User
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return User
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Requis pour la UserInterface, pour éviter les fatal error de l'implements
     */
    public function eraseCredentials()
    {
        //$this->password = null;
    }

    /**
     * @ORM\PrePersist
     */
    public function beforeInsert()
    {
        $this->setDateCreated = new \DateTime();
        $this->setDateModified = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function beforeEdit()
    {
        $this->setDateModified = new \DateTime();
    }


    /**
     * Set longitude
     *
     * @param integer $longitude
     * @return User
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return integer 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     * @return User
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return integer 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creditcards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->carts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add creditcards
     *
     * @param \Bdloc\AppBundle\Entity\CreditCard $creditcards
     * @return User
     */
    public function addCreditcard(\Bdloc\AppBundle\Entity\CreditCard $creditcards)
    {
        $this->creditcards[] = $creditcards;

        return $this;
    }

    /**
     * Remove creditcards
     *
     * @param \Bdloc\AppBundle\Entity\CreditCard $creditcards
     */
    public function removeCreditcard(\Bdloc\AppBundle\Entity\CreditCard $creditcards)
    {
        $this->creditcards->removeElement($creditcards);
    }

    /**
     * Get creditcards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreditcards()
    {
        return $this->creditcards;
    }

    /**
     * Add carts
     *
     * @param \Bdloc\AppBundle\Entity\Cart $carts
     * @return User
     */
    public function addCart(\Bdloc\AppBundle\Entity\Cart $carts)
    {
        $this->carts[] = $carts;

        return $this;
    }

    /**
     * Remove carts
     *
     * @param \Bdloc\AppBundle\Entity\Cart $carts
     */
    public function removeCart(\Bdloc\AppBundle\Entity\Cart $carts)
    {
        $this->carts->removeElement($carts);
    }

    /**
     * Get carts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCarts()
    {
        return $this->carts;
    }


    /**
     * Set mydelivery
     *
     * @param \Bdloc\AppBundle\Entity\DeliveryPoints $mydelivery
     * @return User
     */
    public function setMydelivery(\Bdloc\AppBundle\Entity\DeliveryPoints $mydelivery = null)
    {
        $this->mydelivery = $mydelivery;

        return $this;
    }

    /**
     * Get mydelivery
     *
     * @return \Bdloc\AppBundle\Entity\DeliveryPoints 
     */
    public function getMydelivery()
    {
        return $this->mydelivery;
    }
}
