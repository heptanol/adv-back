<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Fixtures extends Fixture implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder(User::class);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(array('ROLE_READER'));
        $admin->setPassword($encoder->encodePassword('admin', ''));
        $admin->setEnabled(true);



        $user = new User();
        $user->setUsername('heptanol');
        $user->setRoles(array('ROLE_READER'));
        $user->setEmail('user@gmail.com');
        $user->setPassword($encoder->encodePassword('pass', ''));
        $user->setEnabled(true);


        $image1 = new Image();
        $image1->setLatitude('48.8265384');
        $image1->setLongitude('2.2903647000000547');
        $image1->setImage('https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Carrefour_Albert_Legris.jpg/1200px-Carrefour_Albert_Legris.jpg');
        $image1->setTitle('Vanves');
        $image1->setUser($user);

        $image2 = new Image();
        $image2->setLatitude('48.8396952');
        $image2->setLongitude('2.2399123000000145');
        $image2->setImage('http://www.lanouvellegamme.fr/photo/art/grande/9111608-14498973.jpg');
        $image2->setTitle('Boulogne-Billancourt');
        $image2->setUser($user);

        $manager->persist($admin);
        $manager->persist($user);
        $manager->persist($image1);
        $manager->persist($image2);

        $manager->flush();
    }
}