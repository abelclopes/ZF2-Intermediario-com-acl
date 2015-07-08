<?php
namespace ACPLOUser\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    

    public function findOneByActivationKey($key)
    {
         $user = $this->findOneBy(array(
            'activationKey' => $key
        ));
         return $user;
    }
}