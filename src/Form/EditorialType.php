<?php

namespace App\Form;

use App\Entity\Editorial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditorialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $editorial = $options['data'] ?? null;
      $isEdit = $editorial && $editorial->getId();
        $builder
            ->add('title')
            ->add('link_title')
            ->add('link_title_font_size')
            ->add('display_type', ChoiceType::class, [
              'choices'  => [
                'image' => 1,
                'video' => 2,
                'text' => 3
              ]
            ])
            ->add('image', FileType::class,[
              'mapped'=>false,
              'data_class'=>null,
              'required'=>false
            ])
            ->add('video_link', TextType::class,[
              'required'=>false,
              'empty_data' => ''
            ])
            ->add('text', TextareaType::class,[
              'required'=>false,
              'empty_data' => ''
            ])
            ->add('creators')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Editorial::class,
        ]);
    }
}
