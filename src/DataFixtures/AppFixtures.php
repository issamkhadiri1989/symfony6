<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    /**
     * Load dummy user.
     *
     * @param ObjectManager $manager Objet manager
     */
    public function load(ObjectManager $manager): void
    {
        $user = (new User())
            ->setEmail('ikhadiri@gmail.com')
            ->setUsername('issamkhadiri')
            ->setEnabled(true);
        $password = $this->hasher->hashPassword($user, '000000');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
    }
}
