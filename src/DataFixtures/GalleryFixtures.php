<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GalleryFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $new_gallery = new Gallery();
    $new_gallery->setTitle('Gallery');
    $new_gallery->setCreatedAt(new \DateTime());
    $manager->persist($new_gallery);
    $manager->flush();
  }

}