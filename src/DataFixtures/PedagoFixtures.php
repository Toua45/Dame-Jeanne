<?php

namespace App\DataFixtures;

use App\Entity\Pedago;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PedagoFixtures extends Fixture
{
    Const PEDAGO = [
        'Nature' => [
            'title' => 'Nature',
            'content' => 'C\'est comme ça que l\'on qualifie le vin que l\'on aime. Mais pourquoi ?',
            'link' => '',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (self::PEDAGO as $pedago => $data) {
            $pedago = new Pedago();
            $pedago->setTitle($data['title']);
            $pedago->setContent($data['content']);
            $pedago->setLink($faker->url);

            $manager->persist($pedago);
        }

        $manager->flush();
    }
}
