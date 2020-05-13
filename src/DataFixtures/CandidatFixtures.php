<?php

namespace App\DataFixtures;

use App\Entity\Candidat;
use App\Entity\Evenement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class CandidatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        // on créé 10 personnes
        for ($i = 0; $i < 10; $i++) {
            $evenement = new Evenement();
            $evenement->setTitre($faker->title);
            $evenement->setType(Evenement::TYPE_CONCOUR);
            $evenement->setDescription($faker->text);
            $evenement->setDateDebut($faker->dateTimeBetween('-6 years','-4 years'));
            $evenement->setDateFin($faker->dateTimeBetween('-5 years','-4 years'));
            $manager->persist($evenement);
            $manager->flush();
        }


        // on créé 10 personnes
        for ($i = 0; $i < 100; $i++) {
            $evenement = new Candidat();
            $evenement->setNom($faker->name);
            $evenement->setPrenom($faker->lastName);
            $evenement->setSexe($faker->randomLetter);
            $evenement->setLieuCentreConcour($faker->city);
            $evenement->setDateNaissance($faker->dateTimeBetween('-27years','now'));
            $evenement->setLieuNaissance($faker->streetName);
                $evenement->setEvenement(  $manager->getRepository(Evenement::class)->find($faker->randomFloat(10,1)) );
            $manager->persist($evenement);
            $manager->flush();
        }
    }
}
