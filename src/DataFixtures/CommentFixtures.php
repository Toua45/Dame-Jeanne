<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 200; $i++) {
            $comment = new Comment();
            $comment->setAuthor($faker->firstName);
            $comment->setDate($faker->dateTime);
            $comment->setContent($faker->paragraph);
            $comment->setProduct($this->getReference('product_' . rand(0, 130)));
            $manager->persist($comment);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return class-string[]
     */
    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
