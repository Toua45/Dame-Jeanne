<?php

namespace App\DataFixtures;

use App\Entity\Coordinate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CoordinateFixtures extends Fixture
{
    CONST COORDINATE = [
        'name' => 'Dame Jeanne',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::COORDINATE as $coordinate) {
            $coordinate = new Coordinate();
            $coordinate->setName('Dame Jeanne');
            $coordinate->setAdress('111 Rue Colbert');
            $coordinate->setZipCode(37000);
            $coordinate->setCity('Tours');
            $coordinate->setTelephone('0984457781');
            $coordinate->setEmail('dame_jeanne@exemple.com');
            $coordinate->setTimetableOpen(new \DateTime('1970-01-01 15:00:00'));
            $coordinate->setTimetableClose(new \DateTime('1970-01-01 00:00:00'));
            $coordinate->setLatitude('47.3960329');
            $coordinate->setLongitude('0.6915109');
            $coordinate->setTimetableOpenWeekend(new \DateTime('1970-01-01 15:00:00'));
            $coordinate->setTimetableCloseWeekend(new \DateTime('1970-01-01 00:00:00'));

            $manager->persist($coordinate);
        }

        $manager->flush();
    }
}
