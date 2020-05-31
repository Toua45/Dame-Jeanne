<?php

namespace App\DataFixtures;

use App\Entity\Partner;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $partner = new Partner();
            $partner->setName(ucfirst($faker->word));
            $partner->setLink($faker->url);
            $partner->setUpdatedAt(new DateTime());
            $partner->setFilenamePartner('');
            $manager->persist($partner);
        }

        $manager->flush();
    }
}
