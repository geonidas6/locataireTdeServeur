<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class EvenementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
      /*  $faker = Faker\Factory::create('fr_FR');
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
*/

    }
}
