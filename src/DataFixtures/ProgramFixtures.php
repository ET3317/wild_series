<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $programsData = [
            [
                'name' => 'Breaking Bad',
                'synopsis' => 'Un prof de chimie atteint d\'un cancer devient dealer pour subvenir',
                'categoryReference' => 'category_Comedie',
            ],
            [
                'name' => 'Game of Thrones',
                'synopsis' => 'Intrigues politiques et batailles épiques pour le trône de fer',
                'categoryReference' => 'category_Drame',
            ],
            [
                'name' => 'Stranger Things',
                'synopsis' => 'Des enfants affrontent des phénomènes surnaturels dans une petite ville',
                'categoryReference' => 'category_Action',
            ],
            [
                'name' => 'Friends',
                'synopsis' => 'Les aventures et les déboires d\'un groupe d\'amis à New York',
                'categoryReference' => 'category_Comedie',
            ],
            [
                'name' => 'Lost',
                'synopsis' => 'Un avion se crash sur une ile deserte, les survivants sont livrés à eux mêmes',
                'categoryReference' => 'category_Action',
            ],
        ];

        foreach ($programsData as $programData) {
            $program = new Program();
            $program->setName($programData['name']);
            $program->setSynopsis($programData['synopsis']);
            $category = $this->getReference($programData['categoryReference']);
            $program->setCategory($category);
            $manager->persist($program);
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
