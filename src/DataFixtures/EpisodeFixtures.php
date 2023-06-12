<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                for ($k = 1; $k <= 10; $k++) {
                    $episode = new episode();
                    $episode->setTitle($faker->word());
                    $episode->setNumber($k);
                    $episode->setSynopsis($faker->paragraph(2));
                    $episode->setSeasonId($this->getReference('program_' . $i . 'season_' . $j));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}