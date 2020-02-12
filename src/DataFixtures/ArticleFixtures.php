<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 5; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence);
            $article->setContent($faker->paragraph);
            $article->setAuthor($faker->firstName);
            $article->setDate($faker->dateTime);
            $article->setPicture('');
            $article->setImageName('');
            $article->setUpdatedAt(new \DateTime());
            $manager->persist($article);
        }

        $manager->flush();
    }
}
