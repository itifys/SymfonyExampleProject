<?php

namespace App\Controller\Site;

use App\Entity\Editorial;
use App\Form\Editorial1Type;
use App\Repository\EditorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/editorial")
 */
class EditorialController extends AbstractController
{
    /**
     * @Route("/", name="editorial_site_index", methods={"GET"})
     */
    public function index(EditorialRepository $editorialRepository): Response
    {
        return $this->render('site/editorial/index.html.twig', [
            'editorials' => $editorialRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="editorial_site_show", methods={"GET"})
     */
    public function show(Editorial $editorial): Response
    {
        return $this->render('site/editorial/show.html.twig', [
            'editorial' => $editorial,
        ]);
    }
}
