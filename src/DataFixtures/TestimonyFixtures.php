<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Testimony;

class TestimonyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        for ($i = 0; $i < 10; $i++) {
            $testimony = new Testimony();
            $testimony->setName('Testimony ' . $i);
            $testimony->setComment('Quis aute deserunt sint velit. Lorem ipsum dolor si amet.' . $i);
            $testimony->setRate(rand(1, 5));
            $testimony->setEmail('testimony' . $i . '@testimony.com');
            $manager->persist($testimony);
        }
        $manager->flush();
    }
}
