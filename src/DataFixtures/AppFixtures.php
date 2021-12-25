<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\{Article, User};
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\{Factory, Generator};
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;
    private const COUNT_ARTICLES = 10;

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create();
    }

    /**
     * Persists a dummy user into the database.
     *
     * @param ObjectManager $manager The entity manager
     */
    public function load(ObjectManager $manager): void
    {
        $user = (new User())->setEmail('no-reply@system.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setEnabled(false);
        $plainPassword = '123456';
        $hashedPassword = $this->hasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        for ($i = 1; $i <= self::COUNT_ARTICLES; ++$i) {
            $article = (new Article())
                ->setAuthor($user)
                ->setTitle($this->faker->sentence(6))
                ->setDraft($this->faker->boolean())
                ->setPublicationDate($this->faker->dateTimeThisMonth())
                ->setSubtitle($this->faker->sentence(\rand(6, 10)))
                ->setContent('<p>'.\implode('</p><p>', $this->faker->paragraphs(\rand(5, 18))).'</p>');
            $manager->persist($article);
        }
        $manager->flush();
    }
}
