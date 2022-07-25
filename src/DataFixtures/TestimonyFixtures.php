<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Testimony;


class TestimonyFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $testimony = new Testimony();
            $testimony->setName($faker->name());
            $testimony->setComment($faker->text());
            $testimony->setRate(rand(1, 5));
            $testimony->setEmail($faker->email());
            $manager->persist($testimony);
        }
        $manager->flush();
    }
}
