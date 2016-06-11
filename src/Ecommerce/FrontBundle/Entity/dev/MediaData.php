<?php


namespace Ecommerce\FrontBundle\DataFixtures\ORM\dev;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\FrontBundle\Entity\Media;

class MediaData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setPath('legumes.png');
        //$media1->setAlt('Légumes');
        $media1->setName('Légumes');
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setPath('large.jpeg');
        //$media2->setAlt('Fruits');
        $media2->setName('Fruits');
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setPath('b876f70906264390e54636e76e48ca3234a24922.jpg');
        //$media3->setAlt('Poivron rouge');
        $media3->setName('Poivron rouge');
        $manager->persist($media3);

        $media4 = new Media();
        $media4->setPath('b876f70906264390e54636e76e48ca3234a24444.jpg');
        //$media4->setAlt('Piment');
        $media4->setName('Piment');
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setPath('b876f70906264390e54636e76e48ca3234a24999.jpg');
        //$media5->setAlt('Tomate');
        $media5->setName('Tomate');
        $manager->persist($media5);

        $media6 = new Media();
        $media6->setPath('b876f70906264390e54636e76e48ca3234a24997.jpg');
        //$media6->setAlt('Poivron vert');
        $media6->setName('Poivron vert');
        $manager->persist($media6);

        $media7 = new Media();
        $media7->setPath('bc76f70906264390e54636e76e48ca3234a24999.jpg');
        //$media7->setAlt('Raisin');
        $media7->setName('Raisin');
        $manager->persist($media7);

        $media8 = new Media();
        $media8->setPath('bc76f70906264390e54636e76e48ca3234a24998.jpg');
        //$media8->setAlt('Orange');
        $media8->setName('Orange');
        $manager->persist($media8);

        $manager->flush();

        $this->addReference('media1', $media1);
        $this->addReference('media2', $media2);
        $this->addReference('media3', $media3);
        $this->addReference('media4', $media4);
        $this->addReference('media5', $media5);
        $this->addReference('media6', $media6);
        $this->addReference('media7', $media7);
        $this->addReference('media8', $media8);

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}