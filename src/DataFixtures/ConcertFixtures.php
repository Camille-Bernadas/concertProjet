<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Concert;
use App\Repository\HallRepository;
use App\Repository\BandRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ConcertFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(BandRepository $bandRepository, HallRepository $hallRepository)
    {
        $this->bandRepository = $bandRepository;
        $this->hallRepository = $hallRepository;
    }

    public function load(ObjectManager $manager)
    {
        $concert = new Concert();
        $band = $this->bandRepository->findOneBy(['name'=>'Korn']);
        $hall = $this->hallRepository->findOneBy(['name'=>'SpiderHall']);
        $concert->setBand($band)
                ->setDate(\DateTime::createFromFormat("d/m/Y", '01/01/2021'))
                ->setTourName("The last Tour during the End of the World.")
                ->setHall($hall);
        
        $manager->persist($concert);

        $concert = new Concert();
        $band = $this->bandRepository->findOneBy(['name'=>'La Coupole']);
        $hall = $this->hallRepository->findOneBy(['name'=>'MJ Stage']);
        $concert->setBand($band)
                ->setDate(\DateTime::createFromFormat("d/m/Y", '01/12/2021'))
                ->setHall($hall);
        
        $manager->persist($concert);

        $concert = new Concert();
        $band = $this->bandRepository->findOneBy(['name'=>'UnknownKnowledge']);
        $hall = $this->hallRepository->findOneBy(['name'=>'Void Space']);
        $concert->setBand($band)
                ->setDate(\DateTime::createFromFormat("d/m/Y", '01/12/2021'))
                ->setTourName("Covid-19.")
                ->setHall($hall);
        
        $manager->persist($concert);

        $concert = new Concert();
        $band = $this->bandRepository->findOneBy(['name'=>'UnknownKnowledge']);
        $hall = $this->hallRepository->findOneBy(['name'=>'Void Space']);
        $concert->setBand($band)
                ->setDate(\DateTime::createFromFormat("d/m/Y", '31/12/1921'))
                ->setTourName("Spanish Flu")
                ->setHall($hall);
        
        $manager->persist($concert);

        $concert = new Concert();
        $band = $this->bandRepository->findOneBy(['name'=>'UnknownKnowledge']);
        $hall = $this->hallRepository->findOneBy(['name'=>'Void Space']);
        $concert->setBand($band)
                ->setDate(\DateTime::createFromFormat("d/m/Y", '31/12/1821'))
                ->setTourName("Colera Epidemy")
                ->setHall($hall);
        
        $manager->persist($concert);

        $manager->flush();
    }


    /**
     * @inheritDoc
     */
    public function getDependencies(){
        return [
            BandFixtures::class,
            HallFixtures::class,
        ];
    }
}
