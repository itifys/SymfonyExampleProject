<?php

namespace App\Controller\Site;

use App\Controller\Service\UploadService;
use App\Entity\PlayInternal;
use App\Form\PlayInternalType;
use App\Repository\PlayInternalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/play-internal")
 */
class PlayInternalController extends AbstractController
{
    /**
     * @Route("/", name="play_internal_site_index", methods={"GET"})
     */
    public function index(PlayInternalRepository $playInternalRepository, Request $request): Response
    {
      $premiere_date_filter = $request->query->get('premiere_date');
      if ($premiere_date_filter && $premiere_date_filter == 'Premiere date - DESC'){
        $playInternals = $playInternalRepository->findBy([],['premiere_date'=>'desc']);
      }elseif ($premiere_date_filter && $premiere_date_filter == 'Premiere date - ASC'){
        $playInternals = $playInternalRepository->findBy([],['premiere_date'=>'asc']);
      }else{
        $playInternals = $playInternalRepository->findBy([],['premiere_date'=>'desc']);
      }
        return $this->render('site/play_internal/index.html.twig', [
            'play_internals' => $playInternals,
        ]);
    }
}
