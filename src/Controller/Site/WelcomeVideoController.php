<?php

namespace App\Controller\Site;

use App\Entity\WelcomeVideo;
use App\Form\WelcomeVideo1Type;
use App\Repository\WelcomeVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/welcome-video")
 */
class WelcomeVideoController extends AbstractController
{
    /**
     * @Route("/", name="welcome_video_site_index", methods={"GET"})
     */
    public function index(WelcomeVideoRepository $welcomeVideoRepository): Response
    {
        return $this->render('site/welcome_video/index.html.twig', [
            'welcome_video' => $welcomeVideoRepository->findOneBy([], ['id'=>'desc']),
        ]);
    }

}
