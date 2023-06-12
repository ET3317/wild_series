<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        1 =>[
            'name' => 'walkind dead',
            'synopsis' => 'Des zombies envahissent la terre',
            'category'=> 'Action',
        ],
        2 =>[
            'name' => 'How I meet your Mother',
            'synopsis' => "l'histoire d'un père de famille qui raconte ca rencontre",
            'category' => 'Aventure',
        ],
        3 =>[
            'name' => 'naruto',
            'synopsis' => "apprentissage ninja",
            'category' => 'Animation',
        ],
        4 =>[
            'name' => 'chucky',
            'synopsis' => "petite poupée adorable qui découpe des personnes",
            'category' => 'Horreur',
        ],
        5 =>[
            'name' => 'bilbon',
            'synopsis' => "découverte de la terre du milieu",
            'category' => 'Fantastique',
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $key => $values) {

            $program = new Program();
            $program->setName($values['name']);
            $program->setSynopsis($values['synopsis']);
            $program->setCategory($this->getReference('category_'.$values['category']));
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
