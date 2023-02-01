<?php

namespace App\DataFixtures;

use App\Entity\Realisateur;
use App\Entity\Acteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();

        $faker = Factory::create('fr-FR');
        // je veux créér 10 act
        for ($i = 0; $i < 10; $i++) {

            $acteur = new Acteur();
            $acteur->setPrenom($faker->firstName);
            $acteur->setNom($faker->LastName);

            $manager->persist($acteur);
        }

        for ($i = 0; $i < 10; $i++) {

            $realisateur = new Realisateur();
            $realisateur->setPrenom($faker->firstName);
            $realisateur->setNom($faker->LastName);

            $manager->persist($realisateur);
        }

        $manager->flush();
    }
}
