<?php

namespace App\Form;

use App\Entity\PlayExternal;
use App\Entity\PlayVideoLink;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class PlayExternalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $playExternal = $options['data'] ?? null;
      $isEdit = $playExternal && $playExternal->getId();
        $builder
            ->add('poster', FileType::class,[
              'mapped'=>false,
              'data_class'=>null,
              'required'=>!$isEdit
            ])
            ->add('premiere_date')
            ->add('description')
            ->add('photos', CollectionType::class,[
              'entry_type' => PlayPhotoType::class,
              'entry_options' => array(
                'label' => false,
              ),
              'allow_add' => true,
              'allow_delete' => true,
              'by_reference' => false,
              'allow_file_upload' => true,
              'prototype' => true,
              'attr'=>[
                'class'=>'photos'
              ]
            ])
          ->add('video_links', CollectionType::class,[
            'entry_type'=>PlayVideoLinkType::class,
            'entry_options' => array(
              'label' => false,
            ),
            'by_reference' => false,
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'attr'=>[
              'class'=>'video_links'
            ]
          ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayExternal::class,
        ]);
    }
}
