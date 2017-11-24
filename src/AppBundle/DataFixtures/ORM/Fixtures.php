<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
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
        $user->setFirstName('Alaeddine');
        $user->setLastName('Thamine');
        $user->setBirthDate(new \DateTime());
        $user->setSex('homme');
        $user->setEnabled(true);

        $user1 = new User();
        $user1->setUsername('bah');
        $user1->setRoles(array('ROLE_READER'));
        $user1->setEmail('bah@gmail.com');
        $user1->setPassword($encoder->encodePassword('pass', ''));
        $user1->setEnabled(true);

        $user12 = new User();
        $user12->setUsername('dolodes');
        $user12->setRoles(array('ROLE_READER'));
        $user12->setEmail('dolodes@gmail.com');
        $user12->setPassword($encoder->encodePassword('pass', ''));
        $user12->setEnabled(true);

        $userFollowers = new ArrayCollection();
        $userFollowers->add($user1);
        $userFollowers->add($user12);
        $userFollows = new ArrayCollection();
        $userFollows->add($user1);
        $user->setFollows($userFollows);
        $user->setFollowedBy($userFollowers);


        $image1 = new Image();
        $image1->setLatitude('48.8265384');
        $image1->setLongitude('2.2903647000000547');
        $image1->setImage('https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Carrefour_Albert_Legris.jpg/1200px-Carrefour_Albert_Legris.jpg');
        $image1->setTitle('Vanves');
        $image1->setCreatedAt(new \DateTime());
        $image1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image1->setUser($user);

        $image2 = new Image();
        $image2->setLatitude('48.8396952');
        $image2->setLongitude('2.2399123000000145');
        $image2->setImage('http://www.lanouvellegamme.fr/photo/art/grande/9111608-14498973.jpg');
        $image2->setTitle('Boulogne-Billancourt');
        $image2->setCreatedAt(new \DateTime());
        $image1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image2->setUser($user);

        $image3 = new Image();
        $image3->setLatitude('41.820455');
        $image3->setLongitude('12.5354');
        $image3->setImage('http://www.lanouvellegamme.fr/photo/art/grande/9111608-14498973.jpg');
        $image3->setTitle('Via del Casale Marini');
        $image3->setUser($user);

        $manager->persist($admin);
        $manager->persist($user1);
        $manager->persist($user12);
        $manager->persist($user);
        $manager->persist($image1);
        $manager->persist($image2);
        $manager->persist($image3);

        $manager->flush();
    }
}