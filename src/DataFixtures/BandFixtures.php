<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Band;
use App\Repository\MemberRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BandFixtures extends Fixture implements DependentFixtureInterface
{
    private MemberRepository $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function load(ObjectManager $manager)
    {
        $b1= new Band();
        $member_list = $this->memberRepository->findAll();
        $member = $this->memberRepository->findOneBy(['name'=>'Bernadas']);
        $member2 = $this->memberRepository->findOneBy(['name'=>'Khaitrine']);
        $member3 = $this->memberRepository->findOneBy(['name'=>'Tremblay']);
        $member4 = $this->memberRepository->findOneBy(['name'=>'Ruffle']);
        $b1->setName("La Coupole")
            ->setStyle("Hip-Hop")
            ->setPicture("lacoupole.jpg")
            ->setYearOfCreation(\DateTime::createFromFormat("d/m/Y", '25/10/2015'))
            ->setLastAlbumName("L'Eupé")
            ->addMember($member)
            ->addMember($member2)
            ->addMember($member3)
            ->addMember($member4);
        
        $manager->persist($b1);

        $b2= new Band();
        $member = $this->memberRepository->findOneBy(['name'=>'Davies']);
        $member2 = $this->memberRepository->findOneBy(['name'=>'name1']);
        $member3 = $this->memberRepository->findOneBy(['name'=>'name2']);
        $member4 = $this->memberRepository->findOneBy(['name'=>'name5']);
        $b2->setName("Korn")
            ->setStyle("Metal alternatif")
            ->setPicture("korn.jpg")
            ->setYearOfCreation(\DateTime::createFromFormat("d/m/Y", '01/01/1992'))
            ->setLastAlbumName("The nothing")
            ->addMember($member2)
            ->addMember($member3)
            ->addMember($member4)
            ->addMember($member);

        $manager->persist($b2);

        $b3= new Band();
        $member = $this->memberRepository->findOneBy(['name'=>'name3']);
        $member2 = $this->memberRepository->findOneBy(['name'=>'name4']);
        $member3 = $this->memberRepository->findOneBy(['name'=>'name6']);
        $member4 = $this->memberRepository->findOneBy(['name'=>'name7']);
        $b3->setName("UnknownKnowledge")
            ->setStyle("Soul/Ambiant")
            ->setPicture("uk.jpg")
            ->setYearOfCreation(\DateTime::createFromFormat("d/m/Y", '16/08/1892'))
            ->setLastAlbumName("OverTheRainDeer")
            ->addMember($member2)
            ->addMember($member3)
            ->addMember($member4)
            ->addMember($member);

            $manager->persist($b3);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(){
        return [
            MemberFixtures::class,
        ];
    }
}
