<?php

namespace App\Form;

use App\Entity\Entrega;
use App\Entity\Motorista;
use App\Entity\PostoAjuda;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntregaSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('motorista', EntityType::class, [
                'class' => Motorista::class,
                'choice_label' => 'nome',
                'required' => false
            ])
            ->add('postoAjudaDestino', EntityType::class, [
                'class' => PostoAjuda::class,
                'choice_label' => 'descricao',
                'required' => false
            ])
            ->add('observacaoDestino', null, [
                'label' => 'Descrição do destino',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entrega::class,
        ]);
    }
}
