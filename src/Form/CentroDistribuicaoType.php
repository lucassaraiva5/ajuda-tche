<?php

namespace App\Form;

use App\Entity\CentroDistribuicao;
use App\Entity\Cidade;
use App\Entity\Estado;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentroDistribuicaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descricao')
            ->add('estado', EntityType::class, [
                'label' => 'Estado',
                'class' => Estado::class,
                'choice_label' => 'descricao',
            ])
            ->add('cidade', EntityType::class, [
                'label' => 'Cidade',
                'class' => Cidade::class,
                'choice_label' => 'descricao',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CentroDistribuicao::class,
        ]);
    }
}
