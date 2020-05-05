<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 40; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence);
            $article->setContent($faker->paragraph);
            $article->setAuthor($faker->firstName);
            $article->setDate($faker->dateTime);
            $article->setPicture('');
            $article->setImageName('');
            $article->setUpdatedAt(new \DateTime());
            $article->setCategory($this->getReference('category_'. rand(0,4)));
            $manager->persist($article);
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
            CategoryFixtures::class,
        ];
    }
}
