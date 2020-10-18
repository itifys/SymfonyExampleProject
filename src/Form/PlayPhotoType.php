<?php

namespace App\Form;

use App\Entity\PlayPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $playPhoto = $options['data'] ?? null;
      $isEdit = $playPhoto && $playPhoto->getId();
        $builder
            ->add('photo', FileType::class,[
              'mapped'=>false,
              'data_class'=>null,
              'required'=>false,
              'label'=>false,
              'label_attr'=>[
                'class'=>'test'
              ],
            ])
//          ->add('photo')
//            ->add('playExternal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlayPhoto::class,
        ]);
    }
}
