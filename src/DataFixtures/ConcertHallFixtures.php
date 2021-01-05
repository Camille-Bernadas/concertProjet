<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ConcertHall;

class ConcertHallFixtures extends Fixture
{
    public const HALL_1 = 'product1';

    public function load(ObjectManager $manager)
    {
        $product1 = new ConcertHall();
        $product1->setName('MTP')
                ->setTotalPlaces(12000)
                ->setPresentation("En périphérie de Montpellier, le Crazy Concert Carousel vous accueille chaleureusement, sud oblige.")
                ->setCity("Montpellier, 69 rue Valérie Larbaud");
        $manager->persist($product1);


        $product = new ConcertHall();
        $product->setName('RBX')
                ->setTotalPlaces(200)
                ->setPresentation("Dans un coin paumé de Roubaix, le Crazy Concert Carousel vous accueille froidement, parce qu'on ne vous aime pas.")
                ->setCity("Roubaix, 3 Boulevard Tilleur");
        $manager->persist($product);

        $manager->flush();

        $this->addReference(self::HALL_1, $product1);
    }
}
