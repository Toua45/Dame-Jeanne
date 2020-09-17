<?php

namespace App\DataFixtures;

use App\Entity\Pedago;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PedagoFixtures extends Fixture
{
    Const PEDAGO = [
        'Bio' => [
            'title' => 'Bio',
            'content' => 'Le vin biologique existe officiellement depuis très peu de temps (2012). Avant, il ne prenait en compte que la viticulture et non la vinification. 
            Cette démarche oblige dorénavant à n’ajouter aucun traitement synthétique et d’insecticide dans les vignes et, depuis peu, propose à réduire (très légèrement) 
            les intrants lors de la vinification. Par contre, elle autorise l’acidification, la désacidification, le traitement thermique, l’ajout de tanins, 
            l’ajout de copeaux de bois, de soufre, les levures industriels…',
            'link' => '',
        ],
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
