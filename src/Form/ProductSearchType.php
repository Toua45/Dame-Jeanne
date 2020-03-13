<?php

namespace App\Form;

use App\Entity\Section;
use App\Repository\SectionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('search', SearchType::class, [
                'label' => 'Rechercher le nom d\'un produit',
                'required' => false,
            ])
            ->add('section', EntityType::class, [
                'class' => Section::class,
                'label' => 'Catégorie',
                'choice_label' => 'name',
                'query_builder' => function (SectionRepository $sectionRepository) {
                    return $sectionRepository->createQueryBuilder('s')
                        ->orderBy('s.name', 'ASC');
                },
                'required' => false,
                'placeholder' => 'Selectionner la catégorie d\'un produit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
