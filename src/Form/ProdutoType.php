<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\Produto;
use App\Entity\TipoUnidade;
use App\Entity\UnidadeArmazenamento;
use App\Entity\UnidadeConversao;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descricao')
            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'choice_label' => 'descricao',
            ])
            ->add('unidadeArmazenamento', EntityType::class, [
                'class' => UnidadeArmazenamento::class,
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('tiposUnidade', EntityType::class, [
                'class' => TipoUnidade::class,
                'multiple' => true,
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('unidadesConversao', EntityType::class, [
                'class' => UnidadeConversao::class,
                'multiple' => true,
                'required' => false,
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produto::class,
        ]);
    }
}
