<?php

namespace App\Form;

use App\Entity\PostoColeta;
use App\Entity\Produto;
use App\Entity\ProdutoPosto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdutoPostoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantidade')
            ->add('produto', EntityType::class, [
                'class' => Produto::class,
                'choice_label' => 'descricao',
            ])
            ->add('posto', EntityType::class, [
                'class' => PostoColeta::class,
                'choice_label' => 'descricao',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProdutoPosto::class,
        ]);
    }
}
