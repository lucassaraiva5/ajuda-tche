<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\PostoColeta;
use App\Entity\Produto;
use App\Entity\ProdutoPosto;
use App\Entity\TipoUnidade;
use App\Entity\UnidadeArmazenamento;
use App\Entity\UnidadeConversao;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdutoSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'mapped' => false,
                'label' => 'Categoria',
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ],
                'required' => false
            ])
            ->add('descricao', TextType::class, [
                'label' => 'Descrição',
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produto::class,
            'csrf_protection' => false,
        ]);
    }
}
