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
        $user->setAboutMe('Lorem ipsum dolor sit amet, consecte Hac ex causa conlaticia stipe Valerius humatur ille Publicola et subsidiis amicorum mariti inops cum liberis uxor alitur Reguli et dotatur ex aerario filia Scipionis, cum nobilitas florem adultae virginis diuturnum absentia pauperis erubesceret patris.');
        $user->setEnabled(true);
        $user->setProfilePic('https://media.licdn.com/mpr/mpr/shrinknp_200_200/AAEAAQAAAAAAAAcDAAAAJGJlMmM0NzEwLTU1MWEtNDJhMC05NmE1LWFiNTE2MWQyNDQ0Yw.jpg');
        $user->setCoverPic('https://tctechcrunch2011.files.wordpress.com/2014/06/planeflying.jpg');

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
        $image3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image3->setUser($user);

        $image4 = new Image();
        $image4->setLatitude('36.8064948');
        $image4->setLongitude('10.181531599999971');
        $image4->setImage('http://content.maltatoday.com.mt/ui_frontend/thumbnail/684/0/4_tunis.jpg');
        $image4->setTitle('Tunis');
        $image4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image4->setUser($user1);

        $image5 = new Image();
        $image5->setLatitude('35.82450290000001');
        $image5->setLongitude('10.634584000000018');
        $image5->setImage('http://www.tunisiepromo.com/wp-content/uploads/2014/11/sousse.jpg');
        $image5->setTitle('Sousse Tunisie');
        $image5->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image5->setUser($user1);

        $image6 = new Image();
        $image6->setLatitude('64.963051');
        $image6->setLongitude('-19.020835000000034');
        $image6->setImage('https://www.nationalgeographic.com/content/dam/travel/Guide-Pages/europe/Iceland/iceland_NationalGeographic_2168279.adapt.1900.1.jpg');
        $image6->setTitle('Iceland');
        $image6->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image6->setUser($user12);

        $image7 = new Image();
        $image7->setLatitude('60.47202399999999');
        $image7->setLongitude('8.46894599999996');
        $image7->setImage('https://i2.wp.com/www.luxeinacity.com/wp-content/uploads/2015/05/Explore-Norway-Nature-Islands.jpg');
        $image7->setTitle('Norway');
        $image7->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image7->setUser($user12);

        $manager->persist($admin);
        $manager->persist($user1);
        $manager->persist($user12);
        $manager->persist($user);
        $manager->persist($image1);
        $manager->persist($image2);
        $manager->persist($image3);
        $manager->persist($image4);
        $manager->persist($image5);
        $manager->persist($image6);
        $manager->persist($image7);

        $manager->flush();
    }
}