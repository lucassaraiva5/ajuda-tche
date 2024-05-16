<?php

namespace App\Form;

use App\Entity\Cidade;
use App\Entity\CorDaPele;
use App\Entity\Desalojado;
use App\Entity\DesalojadoTipoAbrigo;
use App\Entity\Estado;
use App\Entity\Genero;
use App\Form\DataTransformer\DateStringToDateTimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Regex;

class DesalojadoType extends AbstractType
{

    private $transformer;

    public function __construct(DateStringToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', null, [
                'label' => 'Nome *',
                'attr' => [
                ]
            ])
            ->add('sobrenome', null, [
                'attr' => [
                ]
            ])
            ->add('cpf', null, [
                'label' => 'CPF',
                'attr' => [
                ]
            ])
            ->add('dataNascimento', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{2}\/\d{2}\/\d{4}$/',
                        'message' => 'Por favor, insira uma data no formato dd/mm/yyyy.'
                    ]),
                    new Date([
                        'message' => 'Por favor, insira uma data válida.'
                    ]),
                ],
                'label' => 'Data de Nascimento',
                'required' => false,
                'attr' => [
                    'type' => 'text',
                ]
            ])
            ->add('idade', null, [
                'label' => 'Idade',
                'required' => false,
                'attr' => [
                    'min' => 0,
                    'max' => 120
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
                'label' => 'Genero *',
                'choice_label' => 'descricao',
                'attr' => [
                    'class' => 'select2',
                    'required' => true
                ],
                'required' => true
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
            ->add('estaEmSuaCasa', null, [
                'label' => 'Está em sua Casa?'
            ])
            ->add('cepResidencia', null, [
                'label' => 'CEP da sua residência',
                'required' => false
            ])
            ->add('enderecoAtual', TextareaType::class, [
                'label' => 'Endereço Atual *',
                'required' => true
            ]);

        $builder->get('dataNascimento')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Desalojado::class,
        ]);
    }
}
