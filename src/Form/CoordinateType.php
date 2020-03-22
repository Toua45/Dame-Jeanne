<?php

namespace App\Form;

use App\Entity\Coordinate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
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
                'label' => 'Code postal'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('latitude', TextType::class, [
                'label' => 'Latitude'
            ])
            ->add('longitude', TextType::class, [
                'label' => 'Longitude'
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone'
            ])
            ->add('email', TextType::class, [
                'label' => 'Email'
            ])
            ->add('timetableOpen', TimeType::class, [
                'label' => 'Horaires d\'ouverture'
            ])
            ->add('timetableClose', TimeType::class, [
                'label' => 'Horaires de fermeture'
            ])
            ->add('timetableOpenWeekend', TimeType::class, [
                'label' => 'Horaires d\'ouverture week-end'
            ])
            ->add('timetableCloseWeekend', TimeType::class, [
                'label' => 'Horaires de fermeture week-end'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coordinate::class,
        ]);
    }
}
