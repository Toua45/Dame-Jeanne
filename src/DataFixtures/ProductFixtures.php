<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 30; $i++) {
            $product = new Product();
            $product->setName($faker->sentence);
            $product->setYear($faker->year);
            $product->setDescription($faker->paragraph);
            $product->setType($faker->sentence);
            $product->setPicture('');
            $product->setImageName('');
            $product->setUpdatedAt(new \DateTime());
            $product->setSection($this->getReference('section_'. rand(0,1)));
            $manager->persist($product);
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
            SectionFixtures::class,
        ];
    }
}
