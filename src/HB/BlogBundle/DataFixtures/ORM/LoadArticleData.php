<?php
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php

namespace HB\BlogBundle\DataFixtures\ORM;

//use Doctrine\Common\DataFixtures\FixtureInterface;
//use Doctrine\Common\Persistence\ObjectManager;
//use HB\BlogBundle\Entity\Article;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use HB\BlogBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for($ii=1;$ii<150;$ii++) {
            $LeUser=    $this->getReference('user1');
            $monArticle = new Article();
            $monArticle->setTitle('article fixturé n°'.$ii);
            $monArticle->setContent('Ce magnifique '.$ii+' ième Article fut crée dans Doctrine:Fixture');
            $monArticle->setPublished(true);
            $monArticle->setAuthor($LeUser);
            $manager->persist($monArticle);
        }    
       
        $manager->flush();
        
    }

    /**
     * Permet l'ordre de chargement des fixtures
     * 
     * @return int
     */
    public function getOrder() {
        return 2;
    }

}