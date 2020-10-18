<?php

namespace App\Form;

use App\Entity\QuestionairePart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class QuestionairePartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $questionaire_part = $options['data'] ?? null;
      $isEdit = $questionaire_part && $questionaire_part->getId();

        $builder
            ->add('title')
            ->add('display_type', ChoiceType::class, [
              'choices'  => [
                'image' => 1,
                'text' => 2
              ]
            ])
            ->add('text', TextareaType::class,[
              'required'=>false,
              'empty_data' => ''
            ])
            ->add('image', FileType::class,[
              'mapped'=>false,
              'data_class'=>null,
              'required'=>false
            ])
          ->add('tags', CollectionType::class,[
            'entry_type'=>TagType::class,
            'entry_options' => array(
              'label' => false,
            ),
            'by_reference' => false,
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'attr'=>[
              'class'=>'tags'
            ]
          ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuestionairePart::class,
        ]);
    }
}
