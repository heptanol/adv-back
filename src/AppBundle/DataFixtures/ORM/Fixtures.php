<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setPassword('admin');

        $user = new User();
        $user->setUsername('heptanol');
        $user->setRoles(array('ROLE_USER'));
        $user->setEmail('user@gmail.com');
        $user->setPassword('pass');

        $manager->persist($admin);
        $manager->persist($user);
        
        $manager->flush();
    }
}