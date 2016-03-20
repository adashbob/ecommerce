<?php

namespace PagesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesControllerTest extends WebTestCase
{
    public function testPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/page');
    }

    public function testMenu()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/menu');
    }

}
