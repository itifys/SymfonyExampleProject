<?php

namespace App\Form;

use App\Entity\Gallery;
use App\Entity\GalleryImage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $galleryImage = $options['data'] ?? null;
      $isEdit = $galleryImage && $galleryImage->getId();
        $builder
            ->add('image', FileType::class,[
              'mapped'=>false,
              'data_class'=>null,
              'required'=>!$isEdit
            ])
            ->add('description')
//            ->add('gallery', EntityType::class, [
//              'class' => Gallery::class,
//              'choice_label' => 'title',
//              'placeholder' => 'None',
//              'required' => true,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GalleryImage::class,
        ]);
    }
}
