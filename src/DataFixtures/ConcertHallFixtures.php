<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ConcertHall;

class ConcertHallFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new ConcertHall();
        $product->setName("CCC MTP")
                ->setTotalPlaces(12000)
                ->setPresentation("En périphérie de Montpellier, le Crazy Concert Carousel vous accueille chaleureusement, sud oblige.")
                ->setCity("Montpellier, 69 rue Valérie Larbaud");
        $manager->persist($product);

        $manager->flush();
    }
}
