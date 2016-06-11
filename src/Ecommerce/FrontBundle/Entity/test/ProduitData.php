<?php
namespace Ecommerce\FrontBundle\DataFixtures\ORM\test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\FrontBundle\Entity\Produit;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $produit1 = new Produit();
        $produit1->setCategorie($this->getReference('categorie1'));
        $produit1->setDescription("Le poivron rouge est un groupe de cultivars de l'espèce Capsicum annuum.");
        $produit1->setAvailable('1');
        $produit1->setImage($this->getReference('media3'));
        $produit1->setName('Poivron rouge');
        $produit1->setPrice('1.99');
        $produit1->setTva($this->getReference('tva1'));
        $manager->persist($produit1);

        $produit2 = new Produit();
        $produit2->setCategorie($this->getReference('categorie1'));
        $produit2->setDescription("Piment est généralement associé à la saveur du piquant (pimenté).");
        $produit2->setAvailable('1');
        $produit2->setImage($this->getReference('media4'));
        $produit2->setName('Piment');
        $produit2->setPrice('3.99');
        $produit2->setTva($this->getReference('tva2'));
        $manager->persist($produit2);

        $produit3 = new Produit();
        $produit3->setCategorie($this->getReference('categorie1'));
        $produit3->setDescription("La tomate est une espèce de plantes herbacées de la famille des Solanacées, originaire du nord-ouest de l'Amérique du Sud.");
        $produit3->setAvailable('1');
        $produit3->setImage($this->getReference('media5'));
        $produit3->setName('Tomate');
        $produit3->setPrice('0.99');
        $produit3->setTva($this->getReference('tva2'));
        $manager->persist($produit3);

        $produit4 = new Produit();
        $produit4->setCategorie($this->getReference('categorie1'));
        $produit4->setDescription("Le poivron vert est un groupe de cultivars de l'espèce Capsicum annuum.");
        $produit4->setAvailable('1');
        $produit4->setImage($this->getReference('media6'));
        $produit4->setName('Poivron vert');
        $produit4->setPrice('2.99');
        $produit4->setTva($this->getReference('tva2'));
        $manager->persist($produit4);

        $produit5 = new Produit();
        $produit5->setCategorie($this->getReference('categorie2'));
        $produit5->setDescription("Le raisin est le fruit de la Vigne. Le raisin de la vigne cultivée Vitis vinifera est un des fruits les plus cultivés au monde, avec 68 millions de tonnes produites en 2010.");
        $produit5->setAvailable('1');
        $produit5->setImage($this->getReference('media7'));
        $produit5->setName('Raisin');
        $produit5->setPrice('0.97');
        $produit5->setTva($this->getReference('tva2'));
        $manager->persist($produit5);

        $produit6 = new Produit();
        $produit6->setCategorie($this->getReference('categorie2'));
        $produit6->setDescription("L’orange est un agrume, fruit des orangers, des arbres de différentes espèces de la famille des Rutacées ou d'hybrides de ceux-ci.");
        $produit6->setAvailable('1');
        $produit6->setImage($this->getReference('media8'));
        $produit6->setName('Orange');
        $produit6->setPrice('1.20');
        $produit6->setTva($this->getReference('tva2'));
        $manager->persist($produit6);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}