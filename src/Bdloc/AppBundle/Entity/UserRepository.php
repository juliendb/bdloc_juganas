<?php

namespace Bdloc\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
 
class UserRepository extends EntityRepository implements UserProviderInterface
{
   public function loadUserByUsername($username) {
     return $this->getEntityManager()
         ->createQuery('SELECT u FROM BdlocAppBundle:User u
                        WHERE u.name = :username OR u.email = :username')
         ->setParameters(array('username' => $username))
         ->getOneOrNullResult();
    }
 
    public function refreshUser(UserInterface $user) {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Bdloc\AppBundle\Entity\User';
    }

/*    public function getCoordUser($id)
    {
        $query = $this
            ->createQueryBuilder('u')
            ->addSelect('u.latitude')
            ->addSelect('u.longitude')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

            
            return $query->getSingleResult();
    }
*/

}
