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
            'content' => 'Un vin nature, ou vin naturel, est un vin auquel aucun intrant n\'est ajouté lors de sa vinification (fait parfois exception une faible dose de souffre). 
            À l\'heure actuelle il n\'existe pas de législation ni de consensus autour de sa définition exacte. Cette dénomination n\'est donc pas certifiée. Il est souvent issu 
            de raisins cultivés selon des méthodes agroécologiques (viticulture bilogique ou biodynamique)',
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
