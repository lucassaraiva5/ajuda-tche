<?php

namespace App\Form;

use App\Controller\RegistrationController;
use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Posto de coleta' => RegistrationController::TYPE_POSTO_COLETA,
                    'Abrigo/Centro de distribuição' => RegistrationController::TYPE_CENTRO_DISTRIBUICAO,
                    'Voluntário' => RegistrationController::TYPE_VOLUNTARIO
                ],
                'label' => 'Tipo',
                'mapped' => false, 
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor insira uma senha',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'A sua senha deve conter no minimo {{ limit }} caractéres.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
