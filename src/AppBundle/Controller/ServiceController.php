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
     * @Route("услуги/{page}", name="service_list", defaults={"page" = 1})
     * @ParamConverter("serviceGroup", class="AppBundle:ServiceGroup", options={"mapping" : {"serviceGroupName" = "name"}})
     */
    public function listAction(ServiceGroup $serviceGroup, $page)
    {

        $pagination = $this->get('pagination')->setCollection($serviceGroup->getServices())->setItemsPerPage(5);

        return $this->render('service/index.html.twig', array(
            'serviceGroup' => $serviceGroup,
            'services' => $pagination->getItems($page),
            'page' => $page,
            'pagesCount' => $pagination->getPagesCount()
        ));
    }

    /**
     * @Route("/{serviceName}", name="service_show")
     * @ParamConverter("service", class="AppBundle:Service", options={"mapping" : {"serviceName" = "name"}})
     */
    public function showAction(Service $service)
    {
        return $this->render('service/show.html.twig', array('service' => $service));
    }
} 