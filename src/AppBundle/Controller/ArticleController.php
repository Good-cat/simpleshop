<?php
/**
 * Created by PhpStorm.
 * User: misha
 * Date: 01.05.15
 * Time: 11:20
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/статьи")
 */
class ArticleController extends Controller{

    /**
     * @Route("/{id}/{title}", name="article_show")
     * @ParamConverter("article", class="AppBundle:Article")
     */
    public function showAction(Article $article)
    {
        return $this->render('article/show.html.twig', array('article' => $article));
    }

    /**
     * @Route("", name="article_list")
     */
    public function listAction()
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findAll();

        return $this->render('article/list.html.twig', array('articles' => $articles));
    }
}