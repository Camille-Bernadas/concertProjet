<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName("Bob")
            ->setLastName("Dylan")
            ->setEmail("bobdylan@example.com")
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
        $manager->persist($user);

        $admin = new User();
        $admin->setFirstName("Camille")
            ->setLastName("Bernadas")
            ->setEmail("camillebernadas@gmail.com")
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'symfony'));
        $manager->persist($admin);

        $manager->flush();
    }
}
