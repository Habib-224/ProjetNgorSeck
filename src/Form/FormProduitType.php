<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextType::class,[
                "attr"=>[
                    "class"=>"form-control",
                    "minlenght"=>'2',
                    "maxlenght"=>'50',
                ],

                "label"=>"Libelle",
               
               
            ])
            ->add('stock',NumberType::class,[
                "attr"=>[
                    "class"=>"form-control",
                ],
                "label"=>"Stock",
               
            ])
            ->add('Categorie',EntityType::class,[
                "attr"=>[
                    "class"=>"form-control",
                ],
                "class"=>Categorie::class,
                
            ])
            ->add('submit',SubmitType::class,[
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
