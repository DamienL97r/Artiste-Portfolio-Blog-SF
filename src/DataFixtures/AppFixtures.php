<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Category;
use App\Entity\Paint;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_PAINT = 2;
    private const NB_BLOGPOST = 5;
    private const NB_CATEGORY = 5;
    private const BATCH_SIZE = 20;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $userPainter = new User();
        $userPainter->setEmail('user@painter.com')
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setPhoneNumber($faker->phoneNumber())
            ->setAbout($faker->text(150))
            ->setInstagramAccount('instagram')
            ->setRoles(['ROLE_PAINTER'])
            ->setPassword('$2y$13$.4rPn3ImMuOTa4ia38ULs.QAjWserG9D369rGvJdm893ofKS0bnhO'); // mdp = user

        $manager->persist($userPainter);

        $userAdmin = new User();
        $userAdmin->setEmail('user@admin.com')
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setPhoneNumber($faker->phoneNumber())
            ->setAbout($faker->text(150))
            ->setInstagramAccount('instagram')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword('$2y$13$.4rPn3ImMuOTa4ia38ULs.QAjWserG9D369rGvJdm893ofKS0bnhO'); // mdp = user

        $manager->persist($userAdmin);
        $manager->flush(); // Persist and flush userAdmin to avoid multiple persistent states

        $batchCount = 0;

        for ($i = 0; $i < self::NB_CATEGORY; $i++) {
            $category = new Category();
            $category->setName($faker->text(20))
                     ->setDescription($faker->realTextBetween(10, 50))
                     ->setSlug($faker->slug);

            $manager->persist($category);
            $batchCount++;

            for ($j = 0; $j < self::NB_PAINT; $j++) {
                $paint = new Paint();
                $paint->setName($faker->text(20))
                      ->setWidth($faker->randomFloat(2, 0, 15))
                      ->setHeight($faker->randomFloat(2, 0, 15))
                      ->setOnSale($faker->boolean(30))
                      ->setPrice($faker->randomFloat(2, 0, 500))
                      ->setRealisationDate($faker->dateTimeBetween('-6 month', 'now'))
                      ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                      ->setDescription($faker->realTextBetween(10, 50))
                      ->setPortfolio($faker->boolean(30))
                      ->setSlug($faker->slug)
                      ->setFile('/images/hero_1.jpg')
                      ->addCategory($category)
                      ->setUser($userPainter);

                $manager->persist($paint);
                $batchCount++;

                if ($batchCount % self::BATCH_SIZE === 0) {
                    $manager->flush();
                    $manager->clear(); // Clear the EntityManager to free memory
                }
            }
        }

        for ($i = 0; $i < self::NB_BLOGPOST; $i++) {
            $blogPost = new BlogPost();
            $blogPost->setTitle($faker->text(20))
                     ->setContent($faker->realTextBetween(10, 50))
                     ->setSlug($faker->slug)
                     ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                     ->setUser($userPainter);

            $manager->persist($blogPost);
            $batchCount++;

            if ($batchCount % self::BATCH_SIZE === 0) {
                $manager->flush();
                $manager->clear(); // Clear the EntityManager to free memory
            }
        }

        $manager->flush(); // Persist remaining objects
        $manager->clear(); // Clear the EntityManager to free memory
    }
}
