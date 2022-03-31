<?php

namespace App\Form;

use App\Entity\Contact;
use Doctrine\DBAL\Types\BigIntType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => "Seu Nome",
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira seu nome'
                    ])
                ]
            ])
            ->add('telephone',NumberType::class, [
                'required' => true,
                'label' => "Telefone",
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, digite seu número de telefone'
                    ])
                ]
            ])
            ->add('email',EmailType::class, [
            'required' => true,
            'label' => "Seu Email",
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor, indique o seu endereço de e-mail'
                ])
            ]
        ])
            ->add('message', TextareaType::class, [
                'attr' => ['rows' => 6],
                'required' => true,
                'label' => "A Sua Mensagem",
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, digite uma mensagem'
                    ])
                ]
            ])
            ->add('confidentialite', CheckboxType::class, [
                'label'    => 'Privacidade',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
