<?php
// src\HB\BlogBundle\DataFixtures\ORM\LoadUserData.php

// on est dans le bundle UserBundle
namespace HB\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;        // classe mère
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use HB\UserBundle\Entity\User;
// on n'a plus besoin de User; on passe par fos(friends of symfony) 

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface,
        ContainerAwareInterface
{
    /**
     * Donne accès aux sevices 
     * @var $object 
     */
    private $container; 

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // service (de FOS)
        $userManager=   $this->container->get('fos_user.user_manager');
        
        $monUser = $userManager->createUser();          
       // $monUser->setName('user fixturé n°7');
        $monUser->setUsername('ouaga');
        $monUser->setPlainPassword('secret');
        $monUser->setEmail('vincent.demolombe@sfr.fr');
        //    $monUser->setCreationDate(new \DateTime('now'));
        //      $monUser->setLastEditDate(new \DateTime('now'));
        //      $monUser->setBirthDate(new \DateTime('05/03/2004'));
        $monUser->setEnabled(true);
        $userManager->updateUser($monUser );
        
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

    /**
     * Permet l'ordre de chargement des fixtures
     * 
     * @return int
     */
    public function getOrder() {
        return 1;
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container=    $container;
    }

}