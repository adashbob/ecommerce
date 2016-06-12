<?php

namespace Ecommerce\FrontBundle\Tests\Controller;


use Ecommerce\FrontBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ProduitControllerTest extends WebTestCase
{
    private $client = null;
    private $clientAdmin = null;
    private $em;

    /*public function __construct(){
        $kernel = new AppK;
    }*/

    public function setUp()
    {
        $this->client = static::createClient();

        $this->clientAdmin = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'bobo',
            'PHP_AUTH_PW'   => 'bdiallo',
        ));

        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }


    /**
     * Test touts les urls du controller Ecommerce\FrontBundle\Controller\ProduitController
     */
    public function testPagesAreSuccesful(){

        foreach ($this->providerUrls() as $url) {
            $this->client->request('GET', $url);
            $this->assertTrue($this->client->getResponse()->isSuccessful());
        }
    }

    /**
     * Test touts les urls du controller Ecommerce\BackBundle\Controller\ProduitController
     */
    public function testPagesAdminAreSuccesful(){

        foreach ($this->providerUrlsAdmin() as $route => $url) {
            $this->clientAdmin->request('GET', $url);
            $this->assertEquals(200, $this->clientAdmin->getResponse()->getStatusCode());
            $this->assertEquals(
                $route,
                $this->clientAdmin->getRequest()->attributes->get('_route')
            );
        }
    }

    /**
     * Test l'url /admin/produit/3/delete (correspond au tomate)
     */
    public function testDeleteProduitAction(){
        $this->clientAdmin->request('GET', 'http://ecommerce/admin/produit/3/show');
        $this->assertEquals(200, $this->clientAdmin->getResponse()->getStatusCode());

        $this->clientAdmin->request('DELETE', 'http://ecommerce/admin/produit/3/delete');

        $this->assertEquals(
            'back_produits_delete',
            $this->clientAdmin->getRequest()->attributes->get('_route')
        );

        $this->clientAdmin->request('GET', 'http://ecommerce/admin/produit/3/show');
        $this->assertEquals(404, $this->clientAdmin->getResponse()->getStatusCode());
    }


    /**
     * Test Ecommerce\FrontBundle\Controller\ProduitController::produitsAction
     */
    public function testProduitsAction()
    {
        $crawler = $this->client->request('GET', '/produit/');

        $this->assertEquals(
            'Ecommerce\FrontBundle\Controller\ProduitController::produitsAction',
            $this->client->getRequest()->attributes->get('_controller')
        );
        $this->assertTrue(200 == $this->client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('a:contains("Ecommerce")')->count() == 1);
    }

    /**
     * Test Ecommerce\FrontBundle\Repository\ProduitRepository::recherche
     */
    public function testRechercheQuery()
    {
        $produits = $this->em
            ->getRepository('EcommerceFrontBundle:Produit')
            ->recherche('orange');

        $this->assertTrue(is_a($produits[0], Produit::class));
        $this->assertCount(1, $produits);

    }

    /**
     * Test la request qui trouve les produits d'un panier
     *
     */
    public function testsFindProduitInArrayQuery(){

        $produits = $this->em
            ->getRepository('EcommerceFrontBundle:Produit')
            ->findProduitsInArray(array(2 => 1));

        $this->assertTrue(is_a($produits[0], Produit::class));
        $this->assertCount(1, $produits);
    }

    public function providerUrls()
    {
        return array(
            '/produit/',
            '/produit/presentation/2',
            '/produit/traiterRecherche/'
        );
    }

    public function providerUrlsAdmin()
    {
        $url = 'http://ecommerce/admin/produit/';
        return array(
            'back_produits' => $url,
            'back_produits_create' => $url.'create',
            'back_produits_show' => $url.'2/show',
            'back_produits_update' => $url.'2/update'
        );
    }


    /**
     * @return \Symfony\Component\HttpKernel\KernelInterface
     */
    private function getKernel()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        return $kernel;
    }

}
