<?php

namespace App\DataFixtures;

use App\Entity\Message;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MessageFixtures extends Fixture
{
    const MESSAGES = [
        'Wine' => [
            'text' => 'Nous ce qu\'on aime c\'est aussi servir du vin',
            'imageName' => 'wine.webp',
            'updated_at' => '',
        ],
        'Food' => [
            'text' => 'Nous ce qu\'on aime faire c\'est trouver et servir des bons produits',
            'imageName' => 'food.webp',
            'updated_at' => '',
        ],
        'Sound' => [
            'text' => 'Nous ce qu\'on aime c\'est aussi passer du bon son',
            'imageName' => 'sound.webp',
            'updated_at' => '',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::MESSAGES as $message => $data) {
            $message = new Message();
            $message->setText($data['text']);
            $message->setImageName($data['imageName']);
            $message->setUpdatedAt(new DateTime());

            $manager->persist($message);
        }

        $manager->flush();
    }
}
