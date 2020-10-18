<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\WelcomeVideo;
use App\Form\WelcomeVideoType;
use App\Repository\WelcomeVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/welcome-video")
 */
class WelcomeVideoController extends BaseController
{
    /**
     * @Route("/", name="welcome_video_index", methods={"GET"})
     */
    public function index(WelcomeVideoRepository $welcomeVideoRepository): Response
    {
        return $this->render('admin/welcome_video/index.html.twig', [
            'welcome_videos' => $welcomeVideoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="welcome_video_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $welcomeVideo = new WelcomeVideo();
        $form = $this->createForm(WelcomeVideoType::class, $welcomeVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $videoLink = $this->getVideoLink($form);
            $welcomeVideo->setVideoLink($videoLink);
            $entityManager->persist($welcomeVideo);
            $entityManager->flush();

            return $this->redirectToRoute('welcome_video_index');
        }

        return $this->render('admin/welcome_video/new.html.twig', [
            'welcome_video' => $welcomeVideo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="welcome_video_show", methods={"GET"})
     */
    public function show(WelcomeVideo $welcomeVideo): Response
    {
        return $this->render('admin/welcome_video/show.html.twig', [
            'welcome_video' => $welcomeVideo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="welcome_video_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WelcomeVideo $welcomeVideo): Response
    {
        $form = $this->createForm(WelcomeVideoType::class, $welcomeVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $welcomeVideo->setUpdatedAt(new \DateTime());
            $videoLink = $this->getVideoLink($form);
            $welcomeVideo->setVideoLink($videoLink);
            $entityManager->persist($welcomeVideo);
            $entityManager->flush();

            return $this->redirectToRoute('welcome_video_index');
        }

        return $this->render('admin/welcome_video/edit.html.twig', [
            'welcome_video' => $welcomeVideo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="welcome_video_delete", methods={"DELETE"})
     */
    public function delete(Request $request, WelcomeVideo $welcomeVideo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$welcomeVideo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($welcomeVideo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('welcome_video_index');
    }
}
