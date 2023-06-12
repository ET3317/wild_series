<?php

namespace App\DataFixtures;


use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 5; $i++) {
            for ($j = 0; $j <= 5; $j++) {
                $season = new Season();
                //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                $season->setNumber($j);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgram($this->getReference('program_' . $i));
                $manager->persist($season);
                $this->addReference('program_'. $i . 'season_'. $j, $season);
            }
        }
        $manager->flush();

    }


    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}