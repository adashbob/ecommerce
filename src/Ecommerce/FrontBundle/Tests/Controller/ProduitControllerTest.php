<?php

namespace Ecommerce\FrontBundle\Tests\Controller;


use Ecommerce\FrontBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ProduitControllerTest extends WebTestCase
{
    private $client = null;
    private $clientAdmin = null;

    public function setUp()
    {
        $this->client = static::createClient();

        $this->clientAdmin = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'bobo',
            'PHP_AUTH_PW'   => 'bdiallo',
        ));
    }


    /**
     * Test touts les urls du controller Ecommerce\FrontBundle\Controller\ProduitController
     */
    public function testPagesIsSuccesful(){

        foreach ($this->providerUrls() as $url) {
            $this->client->request('GET', $url);
            $this->assertTrue($this->client->getResponse()->isSuccessful());
        }
    }

    /**
     * Test touts les urls du controller Ecommerce\BackBundle\Controller\ProduitController
     */
    public function testPageAdminIsSuccesful(){

        foreach ($this->providerUrlsAdmin() as $route => $url) {
            $this->clientAdmin->request('GET', $url);
            $this->assertTrue($this->clientAdmin->getResponse()->isSuccessful());
            $this->assertEquals(
                $route,
                $this->clientAdmin->getRequest()->attributes->get('_route')
            );
        }
    }

    /**
     * Test l'url /admin/produit/20/delete
     */
    public function testDeleteProduit(){
        $this->clientAdmin->request('DELETE', 'http://ecommerce/admin/produit/20/delete');

        $this->assertEquals('500', $this->clientAdmin->getResponse()->getStatusCode());

        $this->assertEquals(
            'back_produits_delete',
            $this->clientAdmin->getRequest()->attributes->get('_route')
        );
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
        $result = $this
            ->getKernel()
            ->getContainer()
            ->get('doctrine.orm.default_entity_manager')
            ->getRepository('EcommerceFrontBundle:Produit')
            ->recherche('tomate');

        $this->assertTrue(is_a($result[0], Produit::class));

    }

    /**
     * Test la request qui trouve les produits d'un panier
     */
    public function testFindProduitInArrayQuery(){
        // Ajout du produit 23 dans le panier
        $this->getKernel()->getContainer()->get('panier_session')->addProduit(22);
        // Recherche du produit ajouté
        $result = $this
            ->getKernel()
            ->getContainer()
            ->get('doctrine.orm.default_entity_manager')
            ->getRepository('EcommerceFrontBundle:Produit')
            ->findProduitsInArray(array(22 => 1));

        $this->assertEquals(is_a($result[0], Produit::class));
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

    public function providerUrls()
    {
        return array(
            '/produit/',
            '/produit/presentation/19',
            '/produit/traiterRecherche/'
        );
    }

    public function providerUrlsAdmin()
    {
        $url = 'http://ecommerce/admin/produit/';
        return array(
            'back_produits' => $url,
            'back_produits_create' => $url.'create',
            'back_produits_show' => $url.'19/show',
            'back_produits_update' => $url.'19/update'
        );
    }


}
