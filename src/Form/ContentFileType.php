<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomprenon', TextType::class, ['label' => false])
            ->add('codebancque', TextType::class, ['label' => false])
            ->add('nombanque', TextType::class, ['label' => false])
            ->add('codeguichet', TextType::class, ['label' => false])
            ->add('numcompte', TextType::class, ['label' => false])
            ->add('montant', TextType::class, ['label' => false])
            ->add('motif', TextType::class, ['label' => false])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\ContentFile',
        ]);
    }
}
