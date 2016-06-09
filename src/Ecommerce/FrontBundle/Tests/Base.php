<?php


namespace Ecommerce\FrontBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

abstract class BaseTest extends WebTestCase
{
    /**
     * Test le bon chargements des pages
     */
    public function testPagesIsSuccesful(){
        $client = static::createClient();

        foreach ($this->providerUrls() as $url) {
            $client->request('GET', $url);
            $this->assertTrue($client->getResponse()->isSuccessful());
        }
    }

    abstract public  function providerUrls();

}