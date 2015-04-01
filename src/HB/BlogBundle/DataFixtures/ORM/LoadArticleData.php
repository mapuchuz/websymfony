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
        $monArticle = new Article();
        $monArticle->setTitle('article fixturé n°1');
        $monArticle->setContent('Ce magnifique Article fut crée dans Doctrine:Fixture');
        $monArticle->setPublished(true);
        $manager->persist($monArticle);
        
        $monArticle2 = new Article();
        $monArticle2->setTitle('article fixturé n°2');
        $monArticle2->setContent('Cet AUTRE magnifique Article fut crée dans Doctrine:Fixture');
        $monArticle2->setPublished(true);
        $manager->persist($monArticle2);
        
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