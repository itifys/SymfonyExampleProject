<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Controller\Service\UploadService;
use App\Entity\Editorial;
use App\Form\EditorialType;
use App\Repository\EditorialRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/editorial")
 */
class EditorialController extends BaseController
{
    /**
     * @Route("/", name="editorial_index", methods={"GET"})
     */
    public function index(EditorialRepository $editorialRepository): Response
    {
        return $this->render('admin/editorial/index.html.twig', [
            'editorials' => $editorialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="editorial_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploadService $uploadService): Response
    {
        $editorial = new Editorial();
        $form = $this->createForm(EditorialType::class, $editorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
              $imageFileName = $uploadService->uploadFile(
                $imageFile,
                'uploads/image'
              );
              $editorial->setImage($imageFileName);
            }

            $videoLink = $this->getVideoLink($form);
            if ($videoLink){
            $editorial->setVideoLink($videoLink);
            }
            $entityManager->persist($editorial);
            $entityManager->flush();

            return $this->redirectToRoute('editorial_index');
        }

        return $this->render('admin/editorial/new.html.twig', [
            'editorial' => $editorial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="editorial_show", methods={"GET"})
     */
    public function show(Editorial $editorial): Response
    {
        return $this->render('admin/editorial/show.html.twig', [
            'editorial' => $editorial,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="editorial_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Editorial $editorial, UploadService $uploadService): Response
    {
        $form = $this->createForm(EditorialType::class, $editorial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $editorial->setUpdatedAt(new \DateTime());
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
              $imageFileName = $uploadService->uploadFile(
                $imageFile,
                'uploads/image'
              );
              $editorial->setImage($imageFileName);
            }
            $videoLink = $this->getVideoLink($form);
            if ($videoLink){
              $editorial->setVideoLink($videoLink);
            }
            $entityManager->persist($editorial);
            $entityManager->flush();

            return $this->redirectToRoute('editorial_index');
        }

        return $this->render('admin/editorial/edit.html.twig', [
            'editorial' => $editorial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="editorial_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Editorial $editorial, UploadService $uploadService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$editorial->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($editorial);
            if ($editorial->getImage()){
              $uploadService->delete($editorial->getImage());
            }
            $entityManager->flush();
        }

        return $this->redirectToRoute('editorial_index');
    }
}
