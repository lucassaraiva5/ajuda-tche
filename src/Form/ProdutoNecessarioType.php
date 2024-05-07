<?php

namespace App\Form;

use App\Entity\CentroDistribuicao;
use App\Entity\Produto;
use App\Entity\ProdutoNecessario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdutoNecessarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantidade')
            ->add('produto', EntityType::class, [
                'class' => Produto::class,
                'choice_label' => 'id',
            ])
            ->add('centroDistribuicao', EntityType::class, [
                'class' => CentroDistribuicao::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProdutoNecessario::class,
        ]);
    }
}
