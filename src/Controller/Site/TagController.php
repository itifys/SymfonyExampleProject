<?php

namespace App\Controller\Site;

use App\Controller\BaseController;
use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tag")
 */
class TagController extends BaseController
{
    /**
     * @Route("/", name="tag_site_index", methods={"GET"})
     */
    public function index(TagRepository $tagRepository): Response
    {
      $finalTags = $this->getTags();
      $average = array_values($finalTags);
      $average = array_sum($average) / count($average);

        return $this->render('site/tag/index.html.twig', [
            'tags' => $finalTags,
            'average' => $average
        ]);
    }

    /**
     * @Route("/{id}", name="tag_site_show", methods={"GET"})
     */
    public function show(Tag $tag): Response
    {
        return $this->render('site/tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }


}
