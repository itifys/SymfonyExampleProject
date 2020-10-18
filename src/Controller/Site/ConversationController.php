<?php

namespace App\Controller\Site;

use App\Entity\Conversation;
use App\Form\Conversation1Type;
use App\Repository\ConversationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conversation")
 */
class ConversationController extends AbstractController
{
    /**
     * @Route("/", name="conversation_site_index", methods={"GET"})
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
        return $this->render('site/conversation/index.html.twig', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * @Route("/{id}", name="conversation_site_show", methods={"GET"})
     */
    public function show(Conversation $conversation): Response
    {
        return $this->render('site/conversation/show.html.twig', [
            'conversation' => $conversation,
        ]);
    }

}
