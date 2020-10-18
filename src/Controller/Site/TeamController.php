<?php

namespace App\Controller\Site;

use App\Entity\Team;
use App\Form\Team1Type;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/team")
 */
class TeamController extends AbstractController
{
    /**
     * @Route("/", name="team_site_index", methods={"GET"})
     */
    public function index(TeamRepository $teamRepository): Response
    {
        return $this->render('site/team/index.html.twig', [
            'teams' => $teamRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_site_show", methods={"GET"})
     */
    public function show(Team $team): Response
    {
        return $this->render('site/team/show.html.twig', [
            'team' => $team,
        ]);
    }

}
