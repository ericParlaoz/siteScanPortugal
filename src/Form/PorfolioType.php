<?php

namespace App\Form;

use App\Entity\Porfolio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PorfolioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('ville')
            ->add('superficie')
            ->add('description')
            ->add('iframe')
            ->add('image')
            ->add('link')
            ->add('agence')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Porfolio::class,
        ]);
    }
}
