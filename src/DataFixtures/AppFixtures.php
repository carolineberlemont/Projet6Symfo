<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        
        for($i = 1; $i <= 30; $i++) {        
            $ad = new Ad();

            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $city = $faker->city();
            $country = $faker->country();
            $content = $faker->text($maxNbChars = 200);

            $ad->setTitle($title)
                ->setBirthYear(mt_rand(1900, 2018))
                ->setBirthMonth(mt_rand(1, 12))
                ->setBirthDay(mt_rand(1, 31))
                ->setKind("f")
                ->setCountry($country)
                ->setCity($city)
                ->setContent($content);
            
            $manager->persist($ad);
        }

        $manager->flush();
    }
}
