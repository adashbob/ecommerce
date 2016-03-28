<?php

namespace Ecommerce\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandeControllerTest extends WebTestCase
{
    public function testPreparecommande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/prepareCommande');
    }

}
