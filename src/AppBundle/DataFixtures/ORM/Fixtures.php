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

        $bah = new User();
        $bah->setUsername('bah');
        $bah->setRoles(array('ROLE_READER'));
        $bah->setEmail('bah@gmail.com');
        $bah->setPassword($encoder->encodePassword('pass', ''));
        $bah->setEnabled(true);

        $dolodes = new User();
        $dolodes->setUsername('dolodes');
        $dolodes->setRoles(array('ROLE_READER'));
        $dolodes->setEmail('dolodes@gmail.com');
        $dolodes->setPassword($encoder->encodePassword('pass', ''));
        $dolodes->setEnabled(true);

        $nameless = new User();
        $nameless->setUsername('nameless');
        $nameless->setRoles(array('ROLE_READER'));
        $nameless->setEmail('nameless@gmail.com');
        $nameless->setPassword($encoder->encodePassword('pass', ''));
        $nameless->setEnabled(true);

        $jeff = new User();
        $jeff->setUsername('jeff');
        $jeff->setRoles(array('ROLE_READER'));
        $jeff->setEmail('jeff@gmail.com');
        $jeff->setPassword($encoder->encodePassword('pass', ''));
        $jeff->setEnabled(true);

        $gary = new User();
        $gary->setUsername('gary');
        $gary->setRoles(array('ROLE_READER'));
        $gary->setEmail('gary@gmail.com');
        $gary->setPassword($encoder->encodePassword('pass', ''));
        $gary->setEnabled(true);
        $garyFollows = new ArrayCollection();
        $garyFollows->add($dolodes);
        $garyFollows->add($user);
        $garyFollows->add($jeff);
        $gary->setIFollow($garyFollows);

        $userFollows = new ArrayCollection();
        $userFollows->add($dolodes);
        $userFollows->add($gary);
        $userFollows->add($jeff);
        $userFollows->add($nameless);
        $userFollows->add($bah);
        $user->setIFollow($userFollows);

        $image1 = new Image();
        $image1->setCreatedAt(new \DateTime('2005-01-01'));
        $image1->setLatitude('48.8265384');
        $image1->setLongitude('2.2903647000000547');
        $image1->setImage('https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Carrefour_Albert_Legris.jpg/1200px-Carrefour_Albert_Legris.jpg');
        $image1->setTitle('Vanves');
        $image1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image1->setUser($gary);

        $image2 = new Image();
        $image2->setCreatedAt(new \DateTime('2008-01-01'));
        $image2->setLatitude('48.8396952');
        $image2->setLongitude('2.2399123000000145');
        $image2->setImage('http://www.lanouvellegamme.fr/photo/art/grande/9111608-14498973.jpg');
        $image2->setTitle('Boulogne-Billancourt');
        $image1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image2->setUser($gary);

        $image3 = new Image();
        $image3->setCreatedAt(new \DateTime('2007-01-01'));
        $image3->setLatitude('41.820455');
        $image3->setLongitude('12.5354');
        $image3->setImage('http://www.lanouvellegamme.fr/photo/art/grande/9111608-14498973.jpg');
        $image3->setTitle('Via del Casale Marini');
        $image3->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image3->setUser($gary);

        $image4 = new Image();
        $image4->setCreatedAt(new \DateTime('2000-01-01'));
        $image4->setLatitude('36.8064948');
        $image4->setLongitude('10.181531599999971');
        $image4->setImage('http://content.maltatoday.com.mt/ui_frontend/thumbnail/684/0/4_tunis.jpg');
        $image4->setTitle('Tunis');
        $image4->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image4->setUser($bah);

        $image5 = new Image();
        $image5->setCreatedAt(new \DateTime('2002-01-01'));
        $image5->setLatitude('35.82450290000001');
        $image5->setLongitude('10.634584000000018');
        $image5->setImage('http://www.tunisiepromo.com/wp-content/uploads/2014/11/sousse.jpg');
        $image5->setTitle('Sousse Tunisie');
        $image5->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image5->setUser($bah);

        $image6 = new Image();
        $image6->setCreatedAt(new \DateTime('2002-01-01'));
        $image6->setLatitude('64.963051');
        $image6->setLongitude('-19.020835000000034');
        $image6->setImage('https://www.nationalgeographic.com/content/dam/travel/Guide-Pages/europe/Iceland/iceland_NationalGeographic_2168279.adapt.1900.1.jpg');
        $image6->setTitle('Iceland');
        $image6->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image6->setUser($dolodes);

        $image7 = new Image();
        $image7->setCreatedAt(new \DateTime('2002-01-01'));
        $image7->setLatitude('60.47202399999999');
        $image7->setLongitude('8.46894599999996');
        $image7->setImage('https://i2.wp.com/www.luxeinacity.com/wp-content/uploads/2015/05/Explore-Norway-Nature-Islands.jpg');
        $image7->setTitle('Norway');
        $image7->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image7->setUser($dolodes);

        $image8 = new Image();
        $image8->setCreatedAt(new \DateTime('2002-01-01'));
        $image8->setLatitude('60.47202399999999');
        $image8->setLongitude('8.46894599999996');
        $image8->setImage('https://i2.wp.com/www.luxeinacity.com/wp-content/uploads/2015/05/Explore-Norway-Nature-Islands.jpg');
        $image8->setTitle('Norway');
        $image8->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco');
        $image8->setUser($dolodes);


        $manager->persist($admin);
        $manager->persist($bah);
        $manager->persist($dolodes);
        $manager->persist($user);
        $manager->persist($nameless);
        $manager->persist($jeff);
        $manager->persist($gary);
        $manager->persist($image1);
        $manager->persist($image2);
        $manager->persist($image3);
        $manager->persist($image4);
        $manager->persist($image5);
        $manager->persist($image6);
        $manager->persist($image7);
        $manager->persist($image8);

        $minLat = 43.421009 * 1000000;
        $maxLat = 70.951220 * 1000000;
        $minLgt =  -1.582031 * 1000000;
        $maxLgt =  36.767578 * 1000000;

        for ($i = 0; $i < 130 ; $i++) {
            $im = new Image(mt_rand($minLat, $maxLat)/1000000, mt_rand($minLgt, $maxLgt)/1000000);
            $im->setTitle('test');
            $im->setImage('https://i2.wp.com/www.luxeinacity.com/wp-content/uploads/2015/05/Explore-Norway-Nature-Islands.jpg');
            $im->setUser($user);
            $date = new \DateTime();
            $date->setDate(mt_rand(1990, 2017), mt_rand(1,12), mt_rand(1,28));
            $im->setCreatedAt($date);
            $manager->persist($im);
        }

        $manager->flush();
    }
}