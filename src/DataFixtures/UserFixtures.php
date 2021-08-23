<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends AppFixtures
{
    public const USER = 'USER';

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher  = $passwordHasher;
    }

    public function load(PersistenceObjectManager $manager)
    {
        // Create Yohann Admin
        $yohann = new User();
        $yohann->setEmail('yohanndurand76@gmail.com');
        $yohann->setPassword($this->passwordHasher->hashPassword($yohann,'dev'));
        $yohann->setRoles(["ROLE_ADMIN"]);
        $manager->persist($yohann);

        // Create Yohann Admin
        $sacha = new User();
        $sacha->setEmail('sacha6623@gmail.com');
        $sacha->setPassword($this->passwordHasher->hashPassword($sacha,'000000'));
        $sacha->setRoles(["ROLE_ADMIN"]);
        $manager->persist($sacha);

        // Create User
        $user = new User();
        $user->setEmail('user@gmail.com');
        $user->setPassword($this->passwordHasher->hashPassword($user,'dev'));
        $user->setRoles(["ROLE_USER"]);
        $manager->persist($user);

        $manager->flush();

    }
}