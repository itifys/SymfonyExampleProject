<?php

namespace App\Controller\Admin;

use App\Controller\Service\UploadService;
use App\Entity\GalleryImage;
use App\Form\GalleryImageType;
use App\Repository\GalleryImageRepository;
use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/gallery-image")
 */
class GalleryImageController extends AbstractController
{
    /**
     * @Route("/", name="gallery_image_index", methods={"GET"})
     */
    public function index(GalleryImageRepository $galleryImageRepository): Response
    {
        return $this->render('admin/gallery_image/index.html.twig', [
            'gallery_images' => $galleryImageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gallery_image_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploadService $uploadService, GalleryRepository $galleryRepository): Response
    {
        $galleryImage = new GalleryImage();
        $form = $this->createForm(GalleryImageType::class, $galleryImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
              $imageFileName = $uploadService->uploadFile(
                $imageFile,
                'uploads/image'
              );
            }

            $galleryImage->setGallery($galleryRepository->findOneBy([], ['id'=>'desc']));
            $galleryImage->setImage($imageFileName);
            $entityManager->persist($galleryImage);
            $entityManager->flush();

            return $this->redirectToRoute('gallery_image_index');
        }

        return $this->render('admin/gallery_image/new.html.twig', [
            'gallery_image' => $galleryImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gallery_image_show", methods={"GET"})
     */
    public function show(GalleryImage $galleryImage): Response
    {
        return $this->render('admin/gallery_image/show.html.twig', [
            'gallery_image' => $galleryImage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gallery_image_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GalleryImage $galleryImage, UploadService $uploadService): Response
    {
        $form = $this->createForm(GalleryImageType::class, $galleryImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $galleryImage->setUpdatedAt(new \DateTime());
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
              $imageFileName = $uploadService->uploadFile(
                $imageFile,
                'uploads/image'
              );
              $galleryImage->setImage($imageFileName);
            }
            $entityManager->persist($galleryImage);
            $entityManager->flush();

            return $this->redirectToRoute('gallery_image_index');
        }

        return $this->render('admin/gallery_image/edit.html.twig', [
            'gallery_image' => $galleryImage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gallery_image_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GalleryImage $galleryImage, UploadService $uploadService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galleryImage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($galleryImage);
            $uploadService->delete($galleryImage->getImage());
            $entityManager->flush();
        }

        return $this->redirectToRoute('gallery_image_index');
    }
}
