<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bdloc\AppBundle\Entity\CartRepository")
 */
class Cart
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
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50)
     */
    private $status;




    /**
    *
    * @ORM\ManyToOne(targetEntity="User", inversedBy="carts")
    * @ORM\JoinColumn(nullable = false)
    */
    private $user;



    /**
    *
    * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart")
    */
    private $cartitem;





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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Cart
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
     * @return Cart
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
     * Set status
     *
     * @param string $status
     * @return Cart
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cartitem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set user
     *
     * @param \Bdloc\AppBundle\Entity\User $user
     * @return Cart
     */
    public function setUser(\Bdloc\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Bdloc\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add cartitem
     *
     * @param \Bdloc\AppBundle\Entity\CartItem $cartitem
     * @return Cart
     */
    public function addCartitem(\Bdloc\AppBundle\Entity\CartItem $cartitem)
    {
        $this->cartitem[] = $cartitem;

        return $this;
    }

    /**
     * Remove cartitem
     *
     * @param \Bdloc\AppBundle\Entity\CartItem $cartitem
     */
    public function removeCartitem(\Bdloc\AppBundle\Entity\CartItem $cartitem)
    {
        $this->cartitem->removeElement($cartitem);
    }

    /**
     * Get cartitem
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCartitem()
    {
        return $this->cartitem;
    }
}
