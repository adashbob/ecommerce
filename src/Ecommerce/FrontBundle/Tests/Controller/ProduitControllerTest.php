<?php

namespace Ecommerce\FrontBundle\Tests\Controller;


use Ecommerce\FrontBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ProduitControllerTest extends WebTestCase
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

    public function testHomeProduit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/produit/');

        $this->assertEquals(
            'Ecommerce\FrontBundle\Controller\ProduitController::produitsAction',
            $client->getRequest()->attributes->get('_controller')
        );
        $this->assertTrue(200 == $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('a:contains("Ecommerce")')->count() == 1);
    }

    public function testQuery()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $em = $kernel->getContainer()->get('doctrine.orm.default_entity_manager');

        $result = $em->getRepository('EcommerceFrontBundle:Produit')->recherche('tomate');

        $this->assertTrue(is_a($result[0], Produit::class));

    }

    public function providerUrls()
    {
        return array(
            '/produit/',
            '/produit/presentation/19',
        );
    }

}
