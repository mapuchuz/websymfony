<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller {

    /**
     * @Route("/", name="blog_index")
     * @Route("/page/{page}", name="blog_index_page")
     * @Template("HBBlogBundle:Blog:index.html.twig")
     */
    public function indexAction($page = 1) {
        $em = $this->getDoctrine()->getManager();
        $repo=   $em->getRepository('HBBlogBundle:Article');
        
        $articles = $repo
                ->getHomepageArticles();
        
        $paginator  = $this->get('knp_paginator');
    
        $pagination = $paginator->paginate(
            $articles,
            $page /*page number*/,
            7/*limit per page*/
        );
        
        $pagination->setUsedRoute("blog_index_page");
        $pagination->setTemplate('KnpPaginatorBundle:Pagination:twitter_bootstrap_pagination.html.twig');     # sliding pagination controls template
        
        // envoi vers twig
        return array(
           'pagination' => $pagination
        );
    }

    /**
     * @Route("/showme/{id}", name="blog_show")
     * Route("/{slug}", name="blog_show")
     * @Template("HBBlogBundle:Blog:show.html.twig")
     */
    public function show($id) {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('HBBlogBundle:Article')->find($id);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article.');
        }

        return array('article' => $article);
    }

}
