<?php

namespace App\Form;

use App\Entity\Personalization;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

class PersonalizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color', ColorType::class, array(
                'label' => 'Couleur de Personalisation',
            ))
            ->add('imageFile', VichImageType::class, array(
                'required' => false,
                'label' => 'Logo',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personalization::class,
        ]);
    }
}
