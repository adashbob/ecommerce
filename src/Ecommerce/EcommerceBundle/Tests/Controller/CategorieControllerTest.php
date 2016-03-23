<?php

namespace Ecommerce\EcommerceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategorieControllerTest extends WebTestCase
{
    public function testMenu()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/menu');
    }

}
