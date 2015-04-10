<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace HB\UserBundle\DataFixtures\ORM;

//use Doctrine\Common\DataFixtures\FixtureInterface;
//use Doctrine\Common\Persistence\ObjectManager;
//use HB\BlogBundle\Entity\User;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use HB\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface,
        ContainerAwareInterface
{
    private $container; 
//class LoadUserData implements FixtureInterface
//{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager=   $this->container->get('fos_user.user_manager');
        
        $monUser = $userManager->createUser();   //new User();
        
       // $monUser->setName('user fixturé n°7');
        $monUser->setUsername('ouaga');
        $monUser->setPlainPassword('secret');
        $monUser->setEmail('vincent.demolombe@sfr.fr');
    //    $monUser->setCreationDate(new \DateTime('now'));
  //      $monUser->setLastEditDate(new \DateTime('now'));
  //      $monUser->setBirthDate(new \DateTime('05/03/2004'));
        $monUser->setEnabled(true);
        //$manager->persist($monUser);
        $userManager->updateUser($monUser );
        
     //   $monUser2 = new User();
        $monUser2 = $userManager->createUser();  
     //   $monUser2->setName('user fixturé n°8');
        $monUser2->setUsername('dougou');
        $monUser2->setPlainPassword('secret2');
        $monUser2->setEmail('mapuchuz@gmail.com');
     //   $monUser2->setCreationDate(new \DateTime('now'));  
   //     $monUser2->setLastEditDate(new \DateTime('now'));
  //      $monUser2->setBirthDate(new \DateTime('11/12/2012'));
        $monUser2->setEnabled(true);      
   //     $manager->persist($monUser2);
        
        //$manager->flush();
        $userManager->updateUser($monUser2);
        
        //On stocke dans le Repository de Fixtures des objets à partager
        $this->addReference("user1", $monUser);
        $this->addReference("user2", $monUser2);
    }

    public function getOrder() {
        return 1;
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container=    $container;
    }

}