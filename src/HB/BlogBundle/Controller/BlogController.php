<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class BlogController extends Controller
{
     /**
     * @Route("/", name="blog_index")
     * @Template("HBBlogBundle:Blog:index.html.twig")
     */
    public function indexAction()  {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('HBBlogBundle:Article')->findAll();

        return array(
            'articles' => $articles,
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
