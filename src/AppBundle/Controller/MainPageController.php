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
