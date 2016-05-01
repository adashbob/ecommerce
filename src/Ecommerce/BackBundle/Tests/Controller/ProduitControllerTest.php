<?php

namespace Ecommerce\BackBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    public function testProduits()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/produit/');
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Légume")')->count());
    }
}
