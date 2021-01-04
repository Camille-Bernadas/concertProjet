<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Member;

class MemberFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Member();
        $a1->setName('Davies')
            ->setFirstName('Jonathan')
            ->setJob('Singer')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '18/01/1971'))
            ->setPicture('jonathanDavies.jpg');

        $a2 = new Member();
        $a2->setName('Bernadas')
            ->setFirstName('Camille')
            ->setJob('Singer/Composer')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '17/02/2000'))
            ->setPicture('camilleBernadas.jpg');

        $a3 = new Member();
        $a3->setName('Khaitrine')
            ->setFirstName('Etienne')
            ->setJob('Singer/Composer')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '22/12/1999'))
            ->setPicture('etienneKhaitrine.jpg');
        
        $a4 = new Member();
        $a4->setName('Tremblay')
            ->setFirstName('Alex')
            ->setJob('Singer')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '11/09/2000'))
            ->setPicture('alexTremblay.jpg');
            
        $a5 = new Member();
        $a5->setName('Ruffle')
            ->setFirstName('Derhen')
            ->setJob('Singer')
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", '22/02/2000'))
            ->setPicture('derhenRuffle.jpg');

        for ($i = 0; $i < 10; $i++){
            $member = new Member();
            $member->setName("name" . strval($i))
            ->setFirstName("first_name" . strval($i))
            ->setJob("job" . strval($i))
            ->setBirthDate(\DateTime::createFromFormat("d/m/Y", strval($i) . '/02/2000'))
            ->setPicture("picture");

            $manager->persist($member);
        }
        
        $manager->persist($a1);
        $manager->persist($a2);
        $manager->persist($a3);
        $manager->persist($a4);
        $manager->persist($a5);
        $manager->flush();
    }
}
