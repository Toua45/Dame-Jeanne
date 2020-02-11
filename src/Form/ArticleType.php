<?php

namespace App\Form;

use App\Entity\Article;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('author', TextType::class, [
                'label' => 'Auteur'
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'data' => new DateTime(),
            ])->add('imageFile', VichImageType::class,
                [
                    'label' => 'Image',
                    'required' => false,
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
