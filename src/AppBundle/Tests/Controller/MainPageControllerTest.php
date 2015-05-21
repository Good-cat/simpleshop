<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainPageControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $serviceGroups = static::$kernel->getContainer()->get('doctrine')
            ->getRepository('AppBundle:ServiceGroup')
            ->findBy(array("visible" => 0));

        foreach ($serviceGroups as $serviceGroup) {
            $this->assertFalse($crawler->filter('html:contains("' . $serviceGroup->getName() . '")')->count() > 0, $serviceGroup->getName());
        }
    }
}
