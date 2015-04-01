<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace HB\BlogBundle\DataFixtures\ORM;

//use Doctrine\Common\DataFixtures\FixtureInterface;
//use Doctrine\Common\Persistence\ObjectManager;
//use HB\BlogBundle\Entity\User;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\HelloBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
 
//class LoadUserData implements FixtureInterface
//{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $monUser = new User();
        $monUser->setName('user fixturé n°3');
        $monUser->setLogin('ouaga');
        $monUser->setPassword('secret');
        $monUser->setEmail('vincent.demolombe@sfr.fr');
        $monUser->setCreationDate(new \DateTime('now'));
        $monUser->setLastEditDate(new \DateTime('now'));
        $monUser->setBirthDate(new \DateTime('05/03/2004'));
        $monUser->setEnabled(true);
        $manager->persist($monUser);
        
        $monUser2 = new User();
        $monUser2->setName('user fixturé n°4');
        $monUser2->setLogin('dougou');
        $monUser2->setPassword('secret2');
        $monUser2->setEmail('mapuchuz@gmail.com');
        $monUser2->setCreationDate(new \DateTime('now'));  
        $monUser2->setLastEditDate(new \DateTime('now'));
        $monUser2->setBirthDate(new \DateTime('11/12/2012'));
        $monUser2->setEnabled(true);      
        $manager->persist($monUser2);
        
        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}