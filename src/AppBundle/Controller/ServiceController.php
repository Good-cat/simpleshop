<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Service;
use AppBundle\Entity\ServiceGroup;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/{serviceGroupName}/")
 */
class ServiceController extends Controller{

    /**
     * @Route("услуги", name="service_list")
     * @ParamConverter("serviceGroup", class="AppBundle:ServiceGroup", options={"mapping" : {"serviceGroupName" = "name"}})
     */
    public function listAction(ServiceGroup $serviceGroup)
    {
        $articles = array();
        foreach ($serviceGroup->getServices() as $service) {
            foreach ($service->getTags() as $tag) {
                foreach ($tag->getArticles() as $article)
                $articles[] = $article;
            }
        }

        return $this->render('service/index.html.twig', array(
            'serviceGroup' => $serviceGroup,
            'articles' => $articles
        ));
    }

    /**
     * @Route("/{serviceName}", name="service_show")
     * @ParamConverter("service", class="AppBundle:Service", options={"mapping" : {"serviceName" = "name"}})
     */
    public function showAction(Service $service)
    {
        $articles = array();
        foreach ($service->getTags() as $tag) {
            foreach ($tag->getArticles() as $article)
                $articles[] = $article;
        }

        return $this->render('service/show.html.twig', array(
            'service' => $service,
            'articles' => $articles
        ));
    }
} 