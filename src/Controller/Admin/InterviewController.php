<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Interview;
use App\Form\InterviewType;
use App\Repository\InterviewRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/interview")
 */
class InterviewController extends BaseController
{
    /**
     * @Route("/", name="interview_index", methods={"GET"})
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
        return $this->render('admin/interview/index.html.twig', [
            'interviews' => $interviews,
        ]);
    }

    /**
     * @Route("/new", name="interview_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $interview = new Interview();
        $form = $this->createForm(InterviewType::class, $interview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $videoLink = $this->getVideoLink($form);
            $interview->setVideoLink($videoLink);
            $entityManager->persist($interview);
            $entityManager->flush();

            return $this->redirectToRoute('interview_index');
        }

        return $this->render('admin/interview/new.html.twig', [
            'interview' => $interview,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="interview_show", methods={"GET"})
     */
    public function show(Interview $interview): Response
    {
        return $this->render('admin/interview/show.html.twig', [
            'interview' => $interview,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="interview_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Interview $interview): Response
    {
        $form = $this->createForm(InterviewType::class, $interview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $interview->setUpdatedAt(new \DateTime());
            $videoLink = $this->getVideoLink($form);
            $interview->setVideoLink($videoLink);
            $entityManager->persist($interview);
            $entityManager->flush();

            return $this->redirectToRoute('interview_index');
        }

        return $this->render('admin/interview/edit.html.twig', [
            'interview' => $interview,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="interview_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Interview $interview): Response
    {
        if ($this->isCsrfTokenValid('delete'.$interview->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($interview);
            $entityManager->flush();
        }

        return $this->redirectToRoute('interview_index');
    }
}
