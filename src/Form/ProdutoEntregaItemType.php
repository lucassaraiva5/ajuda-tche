<?php

namespace App\Form;

use App\Entity\CentroDistribuicao;
use App\Entity\Produto;
use App\Entity\ProdutoEntrega;
use App\Entity\ProdutoNecessario;
use App\Entity\ProdutoPosto;
use App\Entity\TipoUnidade;
use App\Entity\UnidadeConversao;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdutoEntregaItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produto', EntityType::class, [
                'class' => Produto::class,
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('tipoUnidade', EntityType::class, [
                'class' => TipoUnidade::class,
                'choice_label' => 'descricao',
                'label' => 'Unidade',
                'attr' => [
                    'class' => 'select2'
                ],
                'mapped' => false
            ])
            ->add('unidadeConversao', EntityType::class, [
                'class' => UnidadeConversao::class,
                'choice_label' => 'descricao',
                'label' => 'Tamanho',
                'attr' => [
                    'class' => 'select2'
                ],
                'mapped' => false
            ])
            ->add('quantidade')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProdutoEntrega::class,
        ]);
    }
}
