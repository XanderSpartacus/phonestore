<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ){}

    public function load(ObjectManager $manager): void
    {
        // USER ADMIN
        $admin = new User();
        $admin->setEmail('admin@phonestore.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin,'password'));
        $admin->setIsVerified(true);

        $manager->persist($admin);

        // USER CLASSIQUE
        $user = new User();
        $user->setEmail('user@phonestore.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user,'password'));
        $user->setIsVerified(true);

        $manager->persist($user);

        $manager->flush();
    }
}
