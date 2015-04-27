<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class sitemapController extends Controller{
    /**
     * @Route("/sitemap.xml", name="sitemap")
     */
    public function sitemapAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $urls = array();
        $hostname = $this->get('request')->getHost();

        $urls[] = array('loc' => $this->get('router')->generate('homepage'), 'changefreq' => 'weekly', 'priority' => '1.0');

        return $this->render('sitemap/index.html.twig', array('urls' => $urls, 'hostname' => $hostname));
    }
} 