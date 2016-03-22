<?php


namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Media;

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
        $media1->setAlt('fruit');
        $media1->setPath('/var/www/Ecommerce-0.30/uploads/b876f70906264390e54636e76e48ca3234a24922.jpg');
        $manager->persist($media1);
        $manager->flush();

        $this->addReference('media1', $media1);

        $media2 = new Media();
        $media2->setAlt('orange');
        $media2->setPath('/var/www/Ecommerce-0.30/uploads/bc76f70906264390e54636e76e48ca3234a24998.jpg');
        $manager->persist($media2);
        $manager->flush();

        $this->addReference('media2', $media2);

        $media3 = new Media();
        $media3->setAlt('pima');
        $media3->setPath('/var/www/Ecommerce-0.30/uploads/b876f70906264390e54636e76e48ca3234a24444.jpg');
        $manager->persist($media3);
        $manager->flush();

        $this->addReference('media3', $media3);

        $media4 = new Media();
        $media4->setAlt('fraise');
        $media4->setPath('/var/www/Ecommerce-0.30/uploads/bc76f70906264390e54636e76e48ca3234a24999.jpg');
        $manager->persist($media4);
        $manager->flush();

        $this->addReference('media4', $media4);

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