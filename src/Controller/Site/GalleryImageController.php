<?php

namespace App\Controller\Site;

use App\Repository\GalleryImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gallery")
 */
class GalleryImageController extends AbstractController
{
    /**
     * @Route("/", name="gallery_image_site_index", methods={"GET"})
     */
    public function index(GalleryImageRepository $galleryImageRepository): Response
    {
        return $this->render('site/gallery_image/index.html.twig', [
            'gallery_images' => $galleryImageRepository->findAll(),
        ]);
    }

}
