<?php

namespace App\Form;

use App\Entity\Coordinate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoordinateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('zipCode', IntegerType::class, [
                'label' => 'Code Postale'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('telephone', IntegerType::class, [
                'label' => 'Téléphone'
            ])
            ->add('email', TextType::class, [
                'label' => 'Email'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coordinate::class,
        ]);
    }
}
