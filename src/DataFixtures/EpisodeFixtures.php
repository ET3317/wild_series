<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $episode = new Episode();
        $episode->setTitle('Welcome to the Playground');
        $episode->setNumber(1);
        $episode->setYear(2000);
        $episode->setSynopsis('synopsis épisode 1');
        $episode->setSeasonId($this->getReference('season1_Lost'));
        $manager -> persist($episode);

        $episode = new Episode();
        $episode->setTitle('Fixture is shit');
        $episode->setNumber(2);
        $episode->setYear(2000);
        $episode->setSynopsis('synopsis épisode 2');
        $episode->setSeasonId($this->getReference('season1_Lost'));
        $manager -> persist($episode);

        $episode = new Episode();
        $episode->setTitle('Bye Bye to the Playground');
        $episode->setNumber(3);
        $episode->setYear(2000);
        $episode->setSynopsis('synopsis épisode 3');
        $episode->setSeasonId($this->getReference('season1_Lost'));
        $manager -> persist($episode);
        $manager ->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}