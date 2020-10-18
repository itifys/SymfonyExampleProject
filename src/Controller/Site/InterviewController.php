<?php

namespace App\Controller\Site;

use App\Entity\Interview;
use App\Form\Interview1Type;
use App\Repository\InterviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/interview")
 */
class InterviewController extends AbstractController
{
    /**
     * @Route("/", name="interview_site_index", methods={"GET"})
     */
    public function index(InterviewRepository $interviewRepository, Request $request): Response
    {
      $interview_filter = $request->query->get('interviews');
      if ($interview_filter && $interview_filter == 'Sort by weight - DESC'){
        $interviews = $interviewRepository->findBy([],['weight'=>'desc']);
      }elseif ($interview_filter && $interview_filter == 'Sort by weight - ASC'){
        $interviews = $interviewRepository->findBy([],['weight'=>'asc']);
      }else{
        $interviews = $interviewRepository->findAll();
      }
        return $this->render('site/interview/index.html.twig', [
            'interviews' => $interviews,
        ]);
    }

    /**
     * @Route("/{id}", name="interview_site_show", methods={"GET"})
     */
    public function show(Interview $interview): Response
    {
        return $this->render('site/interview/show.html.twig', [
            'interview' => $interview,
        ]);
    }

}
