<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;


class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository, RequestStack $requestStack): Response
    {
        $programs = $programRepository->findAll();
        $session = $requestStack->getSession();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    #[Route('/program/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        // Create the form, linked with $program
        if ($form->isSubmitted() && $form->isValid()) {
            $programRepository->save($program, true);
            $this->addFlash('success', 'The new program has been created');
            return $this->redirectToRoute('program_index');
        }
        return $this->render('program/new.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/program/{id}', name: 'program_show', requirements: ['id'=>'\d+'], methods: 'GET')]
    public function show(Program $program): Response
    {
        return $this -> render ('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('/program/{program}/season/{season}', name: 'showSeason')]
    public function showSeason(Program $program, Season $season): Response
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