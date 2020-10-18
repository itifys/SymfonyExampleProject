<?php

namespace App\Controller\Site;

use App\Controller\BaseController;
use App\Entity\QuestionairePart;
use App\Form\QuestionairePart1Type;
use App\Repository\QuestionairePartRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{tag}/questionaire-part")
 */
class QuestionairePartController extends BaseController
{
    /**
     * @Route("/", name="questionaire_part_site_index", methods={"GET"})
     */
    public function index($tag, QuestionairePartRepository $questionairePartRepository, TagRepository $tagRepository): Response
    {
      $tags = $tagRepository->findByQuestionaire($tag);
      $questionaires = [];
      foreach ($tags as $item){
        $questionaires[] = $item->getQuestionairePart();
      }
      $finalTags = $this->getTags();

        return $this->render('site/questionaire_part/index.html.twig', [
            'questionaire_parts' => $questionaires,
            'allTags' => $finalTags,
            'tag' => $tag
        ]);
    }


//    /**
//     * @Route("/{id}", name="questionaire_part_show", methods={"GET"})
//     */
//    public function show(QuestionairePart $questionairePart): Response
//    {
//        return $this->render('questionaire_part/show.html.twig', [
//            'questionaire_part' => $questionairePart,
//        ]);
//    }

}
