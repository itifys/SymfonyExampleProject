<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Conversation;
use App\Form\ConversationType;
use App\Repository\ConversationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("admin/conversation")
 */
class ConversationController extends BaseController
{
    /**
     * @Route("/", name="conversation_index", methods={"GET"})
     */
    public function index(ConversationRepository $conversationRepository, Request $request): Response
    {
      $conversation_filter = $request->query->get('conversations');
      if ($conversation_filter && $conversation_filter == 'Sort by weight - DESC'){
        $conversations = $conversationRepository->findBy([],['weight'=>'desc']);
      }elseif ($conversation_filter && $conversation_filter == 'Sort by weight - ASC'){
        $conversations = $conversationRepository->findBy([],['weight'=>'asc']);
      }else{
        $conversations = $conversationRepository->findAll();
      }
        return $this->render('admin/conversation/index.html.twig', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * @Route("/new", name="conversation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $conversation = new Conversation();
        $form = $this->createForm(ConversationType::class, $conversation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $videoLink = $this->getVideoLink($form);
            $conversation->setVideoLink($videoLink);
            $entityManager->persist($conversation);
            $entityManager->flush();

            return $this->redirectToRoute('conversation_index');
        }

        return $this->render('admin/conversation/new.html.twig', [
            'conversation' => $conversation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conversation_show", methods={"GET"})
     */
    public function show(Conversation $conversation): Response
    {
        return $this->render('admin/conversation/show.html.twig', [
            'conversation' => $conversation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="conversation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Conversation $conversation): Response
    {
        $form = $this->createForm(ConversationType::class, $conversation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $conversation->setUpdatedAt(new \DateTime());
            $videoLink = $this->getVideoLink($form);
            $conversation->setVideoLink($videoLink);
            $entityManager->persist($conversation);
            $entityManager->flush();

            return $this->redirectToRoute('conversation_index');
        }

        return $this->render('admin/conversation/edit.html.twig', [
            'conversation' => $conversation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conversation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Conversation $conversation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conversation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conversation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conversation_index');
    }
}
