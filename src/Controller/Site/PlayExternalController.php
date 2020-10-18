<?php

namespace App\Controller\Site;

use App\Entity\PlayExternal;
use App\Form\PlayExternal1Type;
use App\Repository\PlayExternalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/play-external")
 */
class PlayExternalController extends AbstractController
{
    /**
     * @Route("/", name="play_external_site_index", methods={"GET"})
     */
    public function index(PlayExternalRepository $playExternalRepository): Response
    {
        return $this->render('site/play_external/index.html.twig', [
            'play_externals' => $playExternalRepository->findBy([],['premiere_date'=>'desc']),
        ]);
    }

    /**
     * @Route("/{id}", name="play_external_site_show", methods={"GET"})
     */
    public function show(PlayExternal $playExternal): Response
    {
      $photos = $playExternal->getPhotos();
      $videos = $playExternal->getVideoLinks();

        return $this->render('site/play_external/show.html.twig', [
            'play_external' => $playExternal,
            'photos' => $photos,
            'videos' => $videos
        ]);
    }

}
