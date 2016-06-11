<?php
namespace UserBundle\DataFixtures\ORM\test;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class UserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('bobo');
        $user1->setEmail('bobo@gmail.com');
        $user1->setEnabled(1);
        $user1->setPassword(
            $this->container
                ->get('security.password_encoder')
                ->encodePassword($user1, 'bdiallo')
        );
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('abdou');
        $user2->setEmail('abdou@gmail.com');
        $user2->setEnabled(1);
        $user2->setPassword($this->container
            ->get('security.password_encoder')
            ->encodePassword($user2, 'bdiallo')
        );
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('ada');
        $user3->setEmail('ada@gmail.com');
        $user3->setEnabled(1);
        $user3->setPassword($this->container
            ->get('security.password_encoder')
            ->encodePassword($user3, 'bdiallo')
        );
        $manager->persist($user3);

        $user4 = new User();
        $user4->setUsername('khady');
        $user4->setEmail('khady@gmail.com');
        $user4->setEnabled(1);
        $user4->setPassword($this->container
            ->get('security.password_encoder')
            ->encodePassword($user4, 'bdiallo')
        );
        $manager->persist($user4);

        $user5 = new User();
        $user5->setUsername('balla');
        $user5->setEmail('balla@gmail.com');
        $user5->setEnabled(1);
        $user5->setPassword($this->container
            ->get('security.password_encoder')
            ->encodePassword($user5, 'bdiallo')
        );
        $manager->persist($user5);

        $manager->flush();

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
        $this->addReference('user3', $user3);
        $this->addReference('user4', $user4);
        $this->addReference('user5', $user5);
    }

    public function getOrder()
    {
        return 5;
    }
}