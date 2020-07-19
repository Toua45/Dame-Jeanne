<?php

namespace App\Form;

use App\Entity\Pedago;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Mot de notre dico'
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'La définition',
                'trim' => true,
            ])
            ->add('link', UrlType::class, [
                'label' => 'Lien pour aller plus loin',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pedago::class,
        ]);
    }
}
