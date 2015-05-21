<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServiceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

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
                $this->assertTrue($crawler->filter('h1:contains("' . $service->getName() . '")')->count() > 0, $service->getName());
            }
        }
    }
}