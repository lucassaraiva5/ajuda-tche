<?php

namespace App\Form;

use App\Entity\Cidade;
use App\Entity\Estado;
use App\Entity\PostoColeta;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostoColetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descricao')
            ->add('estado', EntityType::class, [
                'label' => 'Estado',
                'class' => Estado::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('cidade', EntityType::class, [
                'label' => 'Cidade',
                'class' => Cidade::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostoColeta::class,
        ]);
    }
}
