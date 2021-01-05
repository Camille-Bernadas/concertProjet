<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Hall;
use App\Repository\HallRepository;
use App\Repository\ConcertHallRepository;
use App\DataFixtures\ConcertHallFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class HallFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $concertHall = $this->getReference(ConcertHallFixtures::HALL_1);

        $hall = new Hall();
        $hall->setName("MJ Stage")
                ->setCapacity(500)
                ->setConcertHall($concertHall)
                ->setAvailable(true);
        $manager->persist($hall);

        $hall2 = new Hall();
        $hall2->setName("SpiderHall")
                ->setCapacity(800)
                ->setConcertHall($concertHall)
                ->setAvailable(true);
        
        $manager->persist($hall2);

        $hall3 = new Hall();
        $hall3->setName("Void Space")
                ->setCapacity(7777)
                ->setAvailable(false)
                ->setConcertHall($concertHall);
        
        $manager->persist($hall3);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(){
        return [
            ConcertHallFixtures::class,
        ];
    }
    
}
