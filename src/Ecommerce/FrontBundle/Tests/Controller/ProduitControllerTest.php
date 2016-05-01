<?php

namespace Ecommerce\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    public function testProduits()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        var_dump($client->getResponse()->getContent()); die();
        $this->assertGreaterThan(1, $crawler->filter('html:contains("Légumes")')->count());
    }

}
