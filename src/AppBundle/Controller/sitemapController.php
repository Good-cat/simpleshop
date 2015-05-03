<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class sitemapController extends Controller{
    /**
     * @Route("/sitemap.{_format}", name="sitemap", Requirements={"_format" = "xml"})
     */
    public function sitemapAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $urls = array();
        $hostname = $this->get('request')->getHost();
        $scheme = $this->get('request')->getScheme();

        $urls[] = array('loc' => $this->get('router')->generate('homepage'), 'changefreq' => 'weekly', 'priority' => '1.0');
        $urls[] = array('loc' => $this->get('router')->generate('contacts'), 'changefreq' => 'monthly', 'priority' => '0.8');

        foreach ($em->getRepository('AppBundle:Service')->findAll() as $service) {
            $urls[] = array('loc' => $this->get('router')->generate('service_show',
                    array(
                        'serviceName' => $service->getName(),
                        'serviceGroupName' => $service->getServiceGroup()->getName())),
                        'lastmod' => $service->getUpdateAt(),
                        'changefreq' => 'weekly',
                        'priority' => '0.7');
        }

        foreach ($em->getRepository('AppBundle:Article')->findAll() as $article) {
            $urls[] = array('loc' => $this->get('router')->generate('article_show',
                array(
                    'id' => $article->getId(),
                    'title' => $article->getTitle()
                )),
                'lastmod' => $article->getUpdateAt(),
                'changefreq' => 'weekly',
                'priority' => '0.7');
        }

        return $this->render('sitemap/index.xml.twig', array(
            'urls' => $urls,
            'hostname' => $hostname,
            'scheme' => $scheme
            ));
    }
} 