<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class EpisodeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $episode = new Episode();
        $episode->setTitle('Welcome to the Playground');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Lost'));

        $episode = new Episode();
        $episode->setTitle('Fixture is shit');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Lost'));

        $episode = new Episode();
        $episode->setTitle('Bye Bye to the Playground');
        $episode->setNumber(3);
        $episode->setSeason($this->getReference('season1_Lost'));
    }
}