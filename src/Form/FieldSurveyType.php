<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FieldSurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question')
            ->add('typeReply', ChoiceType::class, array(
                'choices'=> [
                    'Texte de moins 255 caratères' =>   "text",
                    'Texte de plus 255 caratères' =>   "textarea",
                    'Coche'                       =>   "checkbox",
                    'Puce'                        =>   "radio",
                    // 'Email'                       =>   "email",
                    'Date'                        =>   "date",
                    'Choix Multiples'              =>  "select",
                ],
                'label' => 'Type de Réponse',
                ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
