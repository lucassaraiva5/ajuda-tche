<?php

namespace App\Form;

use App\Entity\Cidade;
use App\Entity\CorDaPele;
use App\Entity\Desalojado;
use App\Entity\DesalojadoTipoAbrigo;
use App\Entity\Estado;
use App\Entity\Genero;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DesalojadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('sobrenome')
            ->add('cpf', null, [
                'label' => 'CPF',
                'attr' => [
                    'placeholder' => "Opicional"
                ]
            ])
            ->add('nomePai', null, [
                'label' => 'Nome do Pai'
            ])
            ->add('nomeMae', null, [
                'label' => 'Nome da Mãe'
            ])
            ->add('celular', null, [
                'label' => 'Celular'
            ])
            ->add('proprietarioCelular', null, [
                'label' => 'Proprietário do celular'
            ])
            ->add('logradouro', null, [
                'label' => 'Endereço'
            ])
            ->add('numero', null, [
                'label' => 'Numero'
            ])
            ->add('bairro', null, [
                'label' => 'Bairro'
            ])
            ->add('estado', EntityType::class, [
                'label' => 'Estado',
                'class' => Estado::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('cidade', EntityType::class, [
                'label' => 'Cidade',
                'class' => Cidade::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('genero', EntityType::class, [
                'class' => Genero::class,
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('corDaPele', EntityType::class, [
                'class' => CorDaPele::class,
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2'
                ]
            ])
            ->add('desalojadoTipoAbrigo', EntityType::class, [
                'class' => DesalojadoTipoAbrigo::class,
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
            'data_class' => Desalojado::class,
        ]);
    }
}
