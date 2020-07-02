<?php

namespace App\DataFixtures;

use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 4; $i++) {
            $section = new Section();
            $section->setName($faker->word);
            $this->addReference('section_' .$i, $section);
            $manager->persist($section);
        }

        $manager->flush();
    }
}
