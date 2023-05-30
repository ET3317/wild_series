<?php

namespace App\Controller;

use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }


    #[Route('/program/{id}', name: 'program_show', requirements: ['id'=>'\d+'], methods: 'GET')]
    public function show(Program $program): Response
    {
        return $this -> render ('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('/program/{program}/season/{season}', name: 'showSeason')]
    public function showSeason(Program $program, Season $season ): Response
    {
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    #[Route('/program/{program}/season/{season}/episode/{episode}', name: 'showEpisode', methods: ['GET'])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('Episode/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}