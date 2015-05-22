<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServiceControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $serviceGroups = static::$kernel->getContainer()->get('doctrine')
            ->getRepository('AppBundle:ServiceGroup')
            ->findBy(array("visible" => 1));

        foreach ($serviceGroups as $serviceGroup) {
            $crawler = $client->request('GET', '/услуги/' . $serviceGroup->getName());

            $articles = $client->getContainer()->get('doctrine')
                ->getRepository('AppBundle:Article')
                ->findBy(array("visible" => 0));

            foreach ($articles as $article) {
                $this->assertFalse($crawler->filter('html:contains("' . $article->getTitle() . '")')->count() > 0, "Статья \"" . $article->getTitle() . "\" является невидимой, но все равно отображается на странице списка услуг");
            }
        }
    }


    public function testShow()
    {
        $client = static::createClient();
        $serviceGroups = static::$kernel->getContainer()->get('doctrine')
            ->getRepository('AppBundle:ServiceGroup')
            ->findBy(array("visible" => 1));

        foreach ($serviceGroups as $serviceGroup) {
            $services = static::$kernel->getContainer()->get('doctrine')
                ->getRepository('AppBundle:Service')
                ->findBy(array(
                    "visible" => 1,
                    "serviceGroup" => $serviceGroup->getId()
                ));

            foreach ($services as $service) {
                $crawler = $client->request('GET', '/услуги/' . $serviceGroup->getName() . '/' . $service->getName());
                $this->assertTrue($crawler->filter('h1:contains("' . $service->getName() . '")')->count() > 0, "Сервис \"" . $service->getName() . "\" является невидимым, но все равно отображается");

                $articles = $client->getContainer()->get('doctrine')
                    ->getRepository('AppBundle:Article')
                    ->findBy(array("visible" => 0));

                foreach ($articles as $article) {
                    $this->assertFalse($crawler->filter('html:contains("' . $article->getTitle() . '")')->count() > 0, "Статья \"" . $article->getTitle() . "\" является невидимой, но все равно отображается на странице услуги \"" . $service->getName() . "\"");
                }
            }
        }
    }
}