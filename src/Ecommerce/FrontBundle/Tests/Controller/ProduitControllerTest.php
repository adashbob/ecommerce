<?php

namespace Ecommerce\FrontBundle\Tests\Controller;


use Ecommerce\FrontBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


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

        //$this->clientAdmin->request('GET', 'http://ecommerce/login')
    }

    public function testSecuredAdminProduit()
    {
        $crawler = $this->clientAdmin->request('GET', 'http://ecommerce/admin/produit');

        $this->assertTrue($this->clientAdmin->getResponse()->getStatusCode() == 301);
        //static::createClient();
        $this->assertTrue('back_produits' == $this->clientAdmin->getRequest()->attributes->get('_route'));
    }

    /**
     * Test le bon chargements des pages
     */
    public function testPagesIsSuccesful(){

        foreach ($this->providerUrls() as $url) {
            $this->client->request('GET', $url);
            $this->assertTrue($this->client->getResponse()->isSuccessful());
        }
    }

    public function testPageAdminIsSuccesful(){

        foreach ($this->providerUrlsAdmin() as $route => $url) {
            $this->clientAdmin->request('GET', $url);
            $this->assertEquals(
                200,
                $this->clientAdmin->getResponse()->getStatusCode()
            );
            $this->assertEquals(
                $route,
                $this->clientAdmin->getRequest()->attributes->get('_route')
            );
        }
    }

    public function testDeleteProduit(){
        $this->clientAdmin->request('DELETE', 'http://ecommerce/admin/produit/20/delete');

        $this->assertEquals('200', $this->clientAdmin->getResponse()->getStatusCode());

        $this->assertEquals(
            'back_produits_delete',
            $this->clientAdmin->getRequest()->attributes->get('_route')
        );
    }

    public function testHomeProduit()
    {
        $crawler = $this->client->request('GET', '/produit/');

        $this->assertEquals(
            'Ecommerce\FrontBundle\Controller\ProduitController::produitsAction',
            $this->client->getRequest()->attributes->get('_controller')
        );
        $this->assertTrue(200 == $this->client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('a:contains("Ecommerce")')->count() == 1);
    }

    public function testRechercheQuery()
    {
        $kernel = $this->getKernel();

        $em = $kernel->getContainer()->get('doctrine.orm.default_entity_manager');

        $result = $em->getRepository('EcommerceFrontBundle:Produit')->recherche('tomate');

        $this->assertTrue(is_a($result[0], Produit::class));

    }

    /**
     * Test la request qui trouve les produits d'un panier
     */
    public function tesstFindProduitInArrayQuery(){
        // Ajout du produit 23 dans le panier
        $this->getKernel()->getContainer()->get('panier_session')->addProduit(22);
        // Recherche du produit ajouté
        $result = $this
            ->getKernel()
            ->getContainer()
            ->get('doctrine.orm.default_entity_manager')
            ->getRepository('EcommerceFrontBundle:Produit')
            ->findProduitsInArray(array(22 => 1));

        $this->assertTrue(is_a($result[0], Produit::class));
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
