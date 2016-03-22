<?php


namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Client;

class ClientData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $client1 = new Client();
        $client1->setUser($this->getReference('user1'));
        $client1->setNom('Diallo');
        $client1->setPrenom('Bobo');
        $client1->setTelephone('0600000000');
        $client1->setAdresse('3 rue fass mbao');
        $client1->setCp('76600');
        $client1->setPays('Sénégal');
        $client1->setVille('Pikine');
        $client1->setComplement('face à la mosqué');
        $manager->persist($client1);

        $client2 = new Client();
        $client2->setUser($this->getReference('user3'));
        $client2->setNom('Diallo');
        $client2->setPrenom('Ada');
        $client2->setTelephone('0600000000');
        $client2->setAdresse('5 rue rubosca');
        $client2->setCp('76600');
        $client2->setPays('Sénégal');
        $client2->setVille('Rufisque');
        $client2->setComplement('face à la plage');
        $manager->persist($client2);

        $manager->flush();
    }


    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 6;
    }
}