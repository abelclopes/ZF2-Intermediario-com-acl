<?php
namespace ACPLOUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture, Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use ACPLOUser\Entity\User;
use ACPLOUser\Service\User as ServiceUser;


use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Message;



class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{ 
    protected $transport;

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNome("Abel Lopes")
            ->setEmail("abellopes@gmail.com")
            ->setPassword('dqmajjdr')
            ->setActive(Null);
        $this->sendConfirmationEmail($user);
        $manager->persist($user);
        $manager->flush();
        
        
    }

    public function getOrder()
    {
        return 4;
    }
}
