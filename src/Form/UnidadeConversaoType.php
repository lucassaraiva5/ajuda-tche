<?php

namespace App\Form;

use App\Entity\Produto;
use App\Entity\UnidadeArmazenamento;
use App\Entity\UnidadeConversao;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnidadeConversaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descricao')
            ->add('valor')
            ->add('unidadeArmazenamento', EntityType::class, [
                'class' => UnidadeArmazenamento::class,
                'choice_label' => 'descricao',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UnidadeConversao::class,
        ]);
    }
}
