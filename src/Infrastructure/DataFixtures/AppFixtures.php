<?php

namespace App\Infrastructure\DataFixtures;

use App\Infrastructure\Entity\Knight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1,2) as $iteration) {
            $knight = new Knight();
            $knight->setWeaponPower($iteration * 5);
            $knight->setName("Knight $iteration");
            $knight->setStrength($iteration * 7);
            $manager->persist($knight);
        }
        $manager->flush();
    }
}
