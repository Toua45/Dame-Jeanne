<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class TeamFixtures extends Fixture
{
    const TEAMS = [
        'Anne' => [
            'firstname' => 'Alexandre',
            'lastname' => 'B.',
            'email' => 'dame.jeanne37@gmail.com',
            'description' => 'Alexandre a une expérience d’une dizaine d’années notamment dans le service,
            l\'armée et le voyage, ainsi que sur des fonctions supports clés.
            Il est titulaire d’une Maîtrise des Sciences Techniques, Comptables & Financières.
            Expert dans l’appréhension des enjeux globaux des entreprises et l’impact des décisions stratégiques, il
            s’attache à placer l’humain au cœur de toutes actions et privilégie un développement éthique.
            Dotée d’une solide capacité d’écoute et d’un dynamisme communicatif, elle est mue par l’envie d’accompagner
            les organisations dans le respect de chacun vers des réussites collectives !',
            'updated_at' => '',
        ],
        'Quitterie' => [
            'firstname' => 'Marie',
            'lastname' => 'B.',
            'email' => 'dame.jeanne37@gmail.com',
            'description' => 'Marie a travaillé une dizaine d’années en service en France et l\'international.
            De formation initiale Assistante de Direction, elle a par la suite occupé des fonctions commerciales et
            managériales, en passant par le développement de compétences marketing/communication. 
            Elle a acquis une solide expertise dans l’accompagnement du dirigeant à la mise en place de son plan
            d’action avec une approche transversale.
            De nature impliquée, passionnée par les relations humaines, elle met en œuvre une approche responsable des
            problématiques d’entreprise pour plus de bien-être et de performance !',
            'updated_at' => '',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TEAMS as $team => $data) {
            $team = new Team();
            $team->setFirstName($data['firstname']);
            $team->setLastName($data['lastname']);
            $team->setEmail($data['email']);
            $team->setDescription($data['description']);
            $team->setImageName('');
            $team->setUpdatedAt(new DateTime());

            $manager->persist($team);
        }

        $manager->flush();
    }
}
