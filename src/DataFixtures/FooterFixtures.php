<?php

namespace App\DataFixtures;

use App\Entity\Footer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FooterFixtures extends Fixture
{
    const FOOTERS = [
        'Infos' => [
            'address' => '111, rue Colbert 37000 Tours',
            'phone' => '00.00.00.00.00',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::FOOTERS as $footer => $data) {
            $footer = new Footer();
            $footer->setAddress($data['address']);
            $footer->setPhone($data['phone']);

            $manager->persist($footer);
        }

        $manager->flush();
    }
}
