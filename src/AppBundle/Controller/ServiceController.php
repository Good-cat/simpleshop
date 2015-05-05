<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Service;
use AppBundle\Entity\ServiceGroup;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/услуги/{serviceGroupName}")
 */
class ServiceController extends Controller{

    /**
     * @Route("/{page}", name="service_list", defaults={"page" = 1}, requirements={
     *     "page": "\d+"
     * })
     * @ParamConverter("serviceGroup", class="AppBundle:ServiceGroup", options={"mapping" : {"serviceGroupName" = "name"}})
     */
    public function listAction(ServiceGroup $serviceGroup, $page)
    {

        $pagination = $this->get('pagination')->setCollection($serviceGroup->getServices())->setItemsPerPage(5);
        $services = $pagination->getItems($page);

        $articles = array();
        foreach ($services as $service) {
            foreach ($service->getTags() as $tag) {
                foreach ($tag->getArticles() as $article)
                $articles[] = $article;
            }
        }

        return $this->render('service/index.html.twig', array(
            'serviceGroup' => $serviceGroup,
            'articles' => array_unique($articles),
            'services' => $services,
            'page' => $page,
            'pagesCount' => $pagination->getPagesCount()
        ));
    }

    /**
     * @Route("/{serviceName}", name="service_show")
     * @ParamConverter("serviceGroup", class="AppBundle:ServiceGroup", options={"mapping" : {"serviceGroupName" = "name"}})
     * @ParamConverter("service", class="AppBundle:Service", options={"mapping" : {"serviceName" = "name"}})
     */
    public function showAction(ServiceGroup $serviceGroup, Service $service)
    {
        if ($service->getServiceGroup() == $serviceGroup && $service->isVisible()) {
            //точное совпадение ВСЕХ тэгов
            $articles = array();
            //ХОТЯ БЫ ОДИН тэг совпадает
            $additional = array();
            foreach ($service->getTags() as $tag) {
                if (empty($articles)) {
                    $articles = $tag->getArticles()->toArray();
                } else {
                    $articles = array_intersect($articles, $tag->getArticles()->toArray());
                }

                $additional = array_merge($additional, $tag->getArticles()->toArray());
            }
            //убрать те статьи, которые уже есть в точном совпадении
            $additional = array_diff($additional, $articles);

            return $this->render('service/show.html.twig', array(
                'service' => $service,
                'articles' => $articles,
                'additional' => $additional
            ));
        } else {
            throw $this->createNotFoundException('Такая страница не существует!');
        }
    }
} 