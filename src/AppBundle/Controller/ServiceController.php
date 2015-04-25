<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Service;
use AppBundle\Entity\ServiceGroup;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/{serviceGroupName}/услуги")
 */
class ServiceController extends Controller{

    /**
     * @Route("", name="service_list")
     * @ParamConverter("serviceGroup", class="AppBundle:ServiceGroup", options={"mapping" : {"serviceGroupName" = "name"}})
     */
    public function listAction(ServiceGroup $serviceGroup)
    {
        return $this->render('service/index.html.twig', array('serviceList' => $serviceGroup->getServices()));
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