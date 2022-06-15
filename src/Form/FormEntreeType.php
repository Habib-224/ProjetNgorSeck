<?php

namespace App\Form;

use App\Entity\Entree;
use App\Entity\Produit;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormEntreeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Produit',EntityType::class,[
                "attr"=>[
                    "class"=>"form-control",
                ],
                "class"=>Produit::class,
            ])
            ->add('qte',NumberType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    "minlenght"=>'2',
                    "maxlenght"=>'50',
                ],
                'label'=>'quantite-Produit',
            ])
            ->add('prix',NumberType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    "minlenght"=>'2',
                    "maxlenght"=>'50',
                ],
            ])
            ->add('created_at',DateType::class,[
                'attr'=>[
                    'class'=>'form-control',
                ],
            ])
            ->add('submit',SubmitType::class,[
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entree::class,
        ]);
    }
}
