<?php

namespace App\DataFixtures;


use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $season = new Season();
        $season->setNumber(1);
        $season->setProgramId($this->getReference('program_Lost'));

        $this->addReference('season1_Lost', $season);
    }
}