<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstName('Caroline')
                ->setLastname('Berlemont')
                ->setEmail('berlemont2000@yahoo.fr')
                ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                ->setPresentation($faker->sentence())
                ->addUserRole($adminRole);
            $manager->persist($adminUser);
        
        //Nous gérons les utilisateurs
        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();

$hash = $this->encoder->encodePassword($user, 'password');

            $user->setFirstName($faker->firstname)
                ->setLastName($faker->lastname)
                ->setEmail($faker->email)
                ->setPresentation($faker->sentence())
                ->setHash($hash);

        $manager-> persist($user);
        $users[] = $user;
        }

        //Nous gérons les annonces
        for($i = 1; $i <= 30; $i++) {        
            $ad = new Ad();

            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $country = $faker->country();
            $content = $faker->text($maxNbChars = 200);

            $user = $users[mt_rand(0, count($users) - 1)];

            $ad->setTitle($title)
                ->setBirthYear(mt_rand(1900, 2018))
                ->setBirthMonth(mt_rand(1, 12))
                ->setBirthDay(mt_rand(1, 31))
                ->setKind(array_rand(array('feminin', 'masculin', 'inconnu'), 1))
                ->setCountry($country)
                ->setContent($content)
                ->setAuthor($user);
            
            $manager->persist($ad);
        }

        $manager->flush();
    }
}
