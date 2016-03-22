<?php


namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Categorie;
use Ecommerce\EcommerceBundle\Entity\Media;

class CategorieData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categorie = new Categorie();
        $categorie->setName('Fruit');
        $categorie->setImage($this->getReference('media2'));

        $this->addReference('categorie1', $categorie);

        $categorie2 = new Categorie();
        $categorie2->setName('Legumes');
        $categorie2->setImage($this->getReference('media2'));

        $this->addReference('categorie12', $categorie2);

        $categorie3 = new Categorie();
        $categorie3->setName('Fruit fraîche');
        $categorie3->setImage($this->getReference('media4'));

        $this->addReference('categorie3', $categorie3);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}