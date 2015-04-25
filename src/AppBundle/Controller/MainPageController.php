<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MainPage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainPageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $mainPage = $this
            ->getDoctrine()
            ->getRepository('AppBundle:MainPage')
            ->findOneById(1);

        if (!$mainPage) {
            $this->create();
        }

        return $this->render('mainpage/index.html.twig', array('mainpage' => $mainPage));
    }

    public function getHeaderAction()
    {
        $mainPage = $this
            ->getDoctrine()
            ->getRepository('AppBundle:MainPage')
            ->findOneById(1);

        $serviceGroups = $this
            ->getDoctrine()
            ->getRepository('AppBundle:ServiceGroup')
            ->findByVisible(1);

        return $this->render('_navbar.html.twig', array(
            'contacts' => $mainPage->getContacts(),
            'headerText' => $mainPage->getHeader(),
            'serviceGroups' => $serviceGroups
        ));
    }

    private function create()
    {
        $mainPage = new MainPage();
        $mainPage->setTitle("Название главной страницы");
        $mainPage->setContent("Содержание главной страницы (можно добавлять картинки)");
        $mainPage->setNews(true);
        $mainPage->setArticles(true);
        $mainPage->setContacts("Контакты, отображаемые на главной странице");
        $mainPage->setFooter("Текст футера (кроме постоянных значений)");
        $mainPage->setHeader("Текст шапки (кроме постоянных значений)");

        $em = $this->getDoctrine()->getManager();

        $em->persist($mainPage);
        $em->flush();

        return $mainPage;
    }
}
