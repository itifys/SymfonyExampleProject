<?php

namespace App\Controller\Admin;

use App\Controller\Service\UploadService;
use App\Entity\PlayInternal;
use App\Form\PlayInternalType;
use App\Repository\PlayInternalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/play-internal")
 */
class PlayInternalController extends AbstractController
{
    /**
     * @Route("/", name="play_internal_index", methods={"GET"})
     */
    public function index(PlayInternalRepository $playInternalRepository): Response
    {
        return $this->render('admin/play_internal/index.html.twig', [
            'play_internals' => $playInternalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="play_internal_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploadService $uploadService): Response
    {
        $playInternal = new PlayInternal();
        $form = $this->createForm(PlayInternalType::class, $playInternal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imageFile = $form->get('poster')->getData();
            if ($imageFile) {
              $imageFileName = $uploadService->uploadFile(
                $imageFile,
                'uploads/image'
              );
            }

            $playInternal->setPoster($imageFileName);
            $entityManager->persist($playInternal);
            $entityManager->flush();

            return $this->redirectToRoute('play_internal_index');
        }

        return $this->render('admin/play_internal/new.html.twig', [
            'play_internal' => $playInternal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="play_internal_show", methods={"GET"})
     */
    public function show(PlayInternal $playInternal): Response
    {
        return $this->render('admin/play_internal/show.html.twig', [
            'play_internal' => $playInternal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="play_internal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlayInternal $playInternal, UploadService $uploadService): Response
    {
        $form = $this->createForm(PlayInternalType::class, $playInternal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $playInternal->setUpdatedAt(new \DateTime());
            $imageFile = $form->get('poster')->getData();
            if ($imageFile) {
              $imageFileName = $uploadService->uploadFile(
                $imageFile,
                'uploads/image'
              );
              $playInternal->setPoster($imageFileName);
           }
            $entityManager->persist($playInternal);
            $entityManager->flush();

            return $this->redirectToRoute('play_internal_index');
        }

        return $this->render('admin/play_internal/edit.html.twig', [
            'play_internal' => $playInternal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="play_internal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlayInternal $playInternal, UploadService $uploadService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playInternal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($playInternal);
            if ($playInternal->getPoster()){
              $uploadService->delete($playInternal->getPoster());
            }
            $entityManager->flush();
        }

        return $this->redirectToRoute('play_internal_index');
    }
}
