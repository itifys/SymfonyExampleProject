<?php

namespace App\Controller\Admin;

use App\Controller\Service\UploadService;
use App\Entity\QuestionairePart;
use App\Form\QuestionairePartType;
use App\Repository\QuestionairePartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/questionaire-part")
 */
class QuestionairePartController extends AbstractController
{
    /**
     * @Route("/", name="questionaire_part_index", methods={"GET"})
     */
    public function index(QuestionairePartRepository $questionairePartRepository): Response
    {
        return $this->render('admin/questionaire_part/index.html.twig', [
            'questionaire_parts' => $questionairePartRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="questionaire_part_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploadService $uploadService): Response
    {
        $questionairePart = new QuestionairePart();
        $form = $this->createForm(QuestionairePartType::class, $questionairePart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
             $imageFileName = $uploadService->uploadFile(
               $imageFile,
               'uploads/image'
              );
              $questionairePart->setImage($imageFileName);
            }

            $entityManager->persist($questionairePart);
            $entityManager->flush();

            return $this->redirectToRoute('questionaire_part_index');
        }

        return $this->render('admin/questionaire_part/new.html.twig', [
            'questionaire_part' => $questionairePart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="questionaire_part_show", methods={"GET"})
     */
    public function show(QuestionairePart $questionairePart): Response
    {
      $tags = $questionairePart->getTags();
        return $this->render('admin/questionaire_part/show.html.twig', [
            'questionaire_part' => $questionairePart,
            'tags' => $tags
        ]);
    }

    /**
     * @Route("/{id}/edit", name="questionaire_part_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QuestionairePart $questionairePart, UploadService $uploadService): Response
    {
        $form = $this->createForm(QuestionairePartType::class, $questionairePart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $questionairePart->setUpdatedAt(new \DateTime());
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
              $imageFileName = $uploadService->uploadFile(
               $imageFile,
                'uploads/image'
             );
              $questionairePart->setImage($imageFileName);
            }
            $entityManager->persist($questionairePart);
            $entityManager->flush();

            return $this->redirectToRoute('questionaire_part_index');
        }

        return $this->render('admin/questionaire_part/edit.html.twig', [
            'questionaire_part' => $questionairePart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="questionaire_part_delete", methods={"DELETE"})
     */
    public function delete(Request $request, QuestionairePart $questionairePart, UploadService $uploadService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionairePart->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($questionairePart);
            if ($questionairePart->getImage()){
              $uploadService->delete($questionairePart->getImage());
            }
            $entityManager->flush();
        }

        return $this->redirectToRoute('questionaire_part_index');
    }
}
