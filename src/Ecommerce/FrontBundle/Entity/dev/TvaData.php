<?php


namespace Ecommerce\FrontBundle\DataFixtures\ORM\dev;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\FrontBundle\Entity\Tva;

class TvaData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tva1 = new Tva();
        $tva1->setMultiplicate('0.982');
        $tva1->setName('TVA 1.75%');
        $tva1->setValue('1.75');
        $manager->persist($tva1);

        $tva2 = new Tva();
        $tva2->setMultiplicate('0.833');
        $tva2->setName('TVA 20%');
        $tva2->setValue('20');
        $manager->persist($tva2);

        $manager->flush();

        $this->addReference('tva1', $tva1);
        $this->addReference('tva2', $tva2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}