<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'John',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Doe',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'email@hotmail.com',
                ],
            ])
            ->add('subject', ChoiceType::class, [
                'label' => 'Sujet',
                'choices' => [
                    'Choisissez votre option' => 'choose_options',
                    'Demande d\'information' => 'information',
                    'Réservation' => 'reservation'
                ],
            ])
            ->add('message', TextareaType::class, [
                'required' => false,
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Rédigez votre message...',
                    'rows' => 5,
                ],
            ])
            ->add('date', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'label' => 'Date',
            ])
            ->add('timeTable', ChoiceType::class, [
                'label' => 'Heure',
                'choices' => [
                    'Choisissez vos horraires' => 'hours_select',
                    '18:00' => '18:00',
                    '18:15' => '18:15',
                    '18:30' => '18:30',
                    '18:45' => '18:45',
                    '19:00' => '19:00',
                    '19:15' => '19:15',
                    '19:30' => '19:30',
                    '19:45' => '19:45',
                    '20:00' => '20:00',
                    '20:15' => '20:15',
                    '20:30' => '20:30',
                    '20:45' => '20:45',
                    '21:00' => '21:00',
                    '21:15' => '21:15',
                    '21:30' => '21:30',
                    '21:45' => '21:45',
                    '22:00' => '22:00',
                    '22:15' => '22:15',
                    '22:30' => '22:30',
                    '22:45' => '22:45',
                ],
            ])
            ->add('partySize', IntegerType::class, [
                'required' => false,
                'label' => 'Effectif',
                'attr' => [
                    'min' => 1,
                    'max' => 10
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
