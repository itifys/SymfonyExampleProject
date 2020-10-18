<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Tag;

class BaseController extends AbstractController
{
  protected function getVideoLink($form){
    $videoLink = $form->getData()->getVideoLink();
    if ($videoLink){
      if (strpos($videoLink, 'watch') != false || strpos($videoLink, 'youtu.be') != false ){
        $videoLink = 'https://www.youtube.com/embed/'.substr($videoLink, -11);
      }
    }
    return $videoLink;
  }

  protected function getVideoLinks($videoLink){
    if ($videoLink){
      if (strpos($videoLink, 'watch') != false || strpos($videoLink, 'youtu.be') != false ){
        $videoLink = 'https://www.youtube.com/embed/'.substr($videoLink, -11);
      }
    }
    return $videoLink;
  }

  protected function getTags()
  {
    $tagObjects = $this->getDoctrine()->getManager()->getRepository(Tag::class)->findTags();
    $tags = [];
    foreach ($tagObjects as $item){
      $tags[] = $item->getTag();
    }
    $tags = array_values(array_unique($tags));
    $counts = [];
    foreach ($tags as $item){
      $counts[] = count($this->getDoctrine()->getManager()->getRepository(Tag::class)->findByQuestionaire($item));
    }
    $finalTags = array_combine($tags, $counts);
    return $finalTags;
  }

}