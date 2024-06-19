<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $admin = new User();

        $hashedUserPassword = $this->passwordHasher->hashPassword($user, 'user_pass');
        $user->setEmail('user@test.com')
            ->setPassword($hashedUserPassword) 
            ->setRoles(['ROLE_USER']);

        $hashedAdminPassword = $this->passwordHasher->hashPassword($admin, 'admin_pass');
        $admin->setEmail('admin@test.com')
            ->setPassword($hashedAdminPassword) 
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
        $manager->persist($admin);

        $manager->flush();
    }
}
