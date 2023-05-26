<?php

namespace App\Controller;

use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Entity\Episode;


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


    #[Route('/program/{id}', name: 'show', requirements: ['id'=>'\d+'], methods: 'GET')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        if (!$program) {
            throw $this -> createNotFoundException(
                'NO program with id : ' .$id. ' found in program\'s table. '
            );
        }
        return $this -> render ('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('/program/{programId}/season/{seasonId}', name:'showSeason')]

    public function showSeason(ProgramRepository $programRepository, $seasonId, $programId, SeasonRepository $seasonRepository):Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        return $this -> render ('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    #[Route('/program/{program}/season/{season}/episode/{episode}', name: 'showEpisode')]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}