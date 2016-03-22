<?php


namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Categorie;

class CategorieData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categorie();
        $categorie1->setName('Légumes');
        $categorie1->setImage($this->getReference('media3'));
        $manager->persist($categorie1);

        $categorie2 = new Categorie();
        $categorie2->setName('fruits');
        $categorie2->setImage($this->getReference('media4'));
        $manager->persist($categorie2);

        $manager->flush();

        $this->addReference('categorie1', $categorie1);
        $this->addReference('categorie2', $categorie2);
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