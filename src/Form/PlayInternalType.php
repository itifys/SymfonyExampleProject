<?php

namespace App\Form;

use App\Entity\PlayInternal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayInternalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $playInternal = $options['data'] ?? null;
      $isEdit = $playInternal && $playInternal->getId();

        $builder
            ->add('poster', FileType::class,[
              'mapped'=>false,
              'data_class'=>null,
              'required'=>!$isEdit
            ])
            ->add('premiere_date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayInternal::class,
        ]);
    }
}
