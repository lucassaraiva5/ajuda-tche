<?php

namespace App\Form;

use App\Entity\Funcao;
use App\Entity\PostoColeta;
use App\Entity\Usuario;
use App\Entity\Voluntario;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoluntarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', null, [
                'label' => 'Nome'
            ])
            ->add('sobrenome', null, [
                'label' => 'Sobrenome'
            ])
            ->add('ehAluno', null, [
                'label' => 'Você é Aluno da ULBRA?'
            ])
            ->add('codigoArea', null, [
                'label' => 'Código de área',
                'attr' => [
                    'placeholder' => '51'
                ]
            ])
            ->add('telefone', null, [
                'label' => 'Telefone'
            ])
            ->add('postoColeta', EntityType::class, [
                'label' => 'Posto de coleta',
                'class' => PostoColeta::class,
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('funcoes', EntityType::class, [
                'class' => Funcao::class,
                'choice_label' => 'descricao',
                'multiple' => true,
                'attr' => [
                    'class' => 'select2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voluntario::class,
        ]);
    }
}
