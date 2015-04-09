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

        $articles = $em->getRepository('HBBlogBundle:Article')
                ->getHomepageArticles($page);
        
        // nombre de pages affichables
        $nbPage = $em->getRepository('HBBlogBundle:Article')->getPageCount();
     
        // lien vers la page suivante
        $suiv = $page >= $nbPage ? $nbPage : $page + 1; //$suiv--;
        $lienPageSuivante = $this->generateUrl("blog_index_page", array("page" => $suiv));

        // lien vers la page précédente
        $prec = $page <= 1 ? 1 : $page - 1; // $prec--;
        $lienPagePrecedente = $this->generateUrl("blog_index_page", array("page" => $prec));

        // envoi vers twig
        return array('articles' => $articles,
            'lienPageSuivante' => $lienPageSuivante,
            'lienPagePrecedente' => $lienPagePrecedente,
            'page' => $page,
            'nbPages' => $nbPage);
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
