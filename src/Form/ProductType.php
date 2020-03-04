<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Section;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit'
            ])
            ->add('year', TextType::class, [
                'label' => 'Date'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du produit'
            ])
            ->add('type', TextType::class, [
                'label' => 'Type de produit'
            ])
            ->add('section', EntityType::class, [
                'class' => Section::class,
                'label' => 'Section du produit',
                'choice_label' => 'name',
            ])
            ->add('imageFile', VichImageType::class,
                [
                    'label' => 'Image',
                    'required' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
