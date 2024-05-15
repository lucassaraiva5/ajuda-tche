<?php

namespace App\Form;

use App\Entity\Produto;
use App\Entity\UnidadeArmazenamento;
use App\Entity\UnidadeConversao;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnidadeConversaoSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descricao', null, [
                'required' => false
            ])
            ->add('valor', null, [
                'required' => false
            ])
            // ->add('unidadeArmazenamento', EntityType::class, [
            //     'class' => UnidadeArmazenamento::class,
            //     'choice_label' => 'descricao',
            //     'required' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UnidadeConversao::class,
            'csrf_protection' => false,
        ]);
    }
}
