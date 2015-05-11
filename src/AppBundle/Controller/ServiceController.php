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
        $allServices = $serviceGroup->getServices()->filter(function($service) {
            return $service->isVisible() == 1;
        });

        //если в группе всего один сервис, то список не выводится, а происходит перенаправление сразу на отображение этого единственного сервиса
        if ($allServices->count() == 1) {
            return $this->redirectToRoute('service_show', array(
                'serviceGroupName' => $serviceGroup->getName(),
                'serviceName' => $allServices->first()->getName()));
        }

        $pagination = $this->get('pagination')->setCollection($allServices)->setItemsPerPage(Service::SERVICES_PER_PAGE);
        $pageServices = $pagination->getItems($page);

        $articles = array();
        foreach ($pageServices as $service) {
            if ($service->isVisible()){
                foreach ($service->getTags() as $tag) {
                    $articles = array_merge($articles, $tag->getArticles()->toArray());
                }
            }
        }

        return $this->render('service/index.html.twig', array(
            'serviceGroup' => $serviceGroup,
            'articles' => array_unique($articles),
            'services' => $pageServices,
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
            $articles = $service->getTags()->first()->getArticles()->toArray();
            //ХОТЯ БЫ ОДИН тэг совпадает
            $additional = array();
            foreach ($service->getTags() as $tag) {
                //остаются только совпадающие элементы массивов (пересечение массивов)
                $articles = array_intersect($articles, $tag->getArticles()->toArray());
                //массивы складываются, т.е. "собираются" все статьи, имеющие хотя бы один общий с услугой тэг
                $additional = array_merge($additional, $tag->getArticles()->toArray());
            }
            //убрать те статьи, которые уже есть в точном совпадении
            $additional = array_diff($additional, $articles);

            return $this->render('service/show.html.twig', array(
                'service' => $service,
                'articles' => array_unique($articles),
                'additional' => $additional
            ));
        } else {
            throw $this->createNotFoundException('Такая страница не существует!');
        }
    }
} 