<?php

namespace App\Form;

use App\Entity\FieldSurvey;

use App\Enum\ResponseTypeEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldSurveyType extends AbstractType
{
    private $survey_id;

    public function __construct($survey_id=null) 
    {
      $this->survey_id = $survey_id;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question')
            ->add('typeResponse', ChoiceType::class, array(
                'choices'=> [
                    'Coche'                       =>   "checkbox",
                    'Puce'                        =>   "ratio",
                    'Email'                       =>   "email",
                    'Date'                        =>   "date",
                    'Choix Myltiple'              =>   "select",
                    'Téléchargement de fichier'   =>   "file",
                    'Texte de moins 255 caratère' =>   "text",
                    'Texte de plus 255 caratères' =>   "texterea"
                    ]
            ))
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FieldSurvey::class,
            'current_survey' => array()
        ]);
    }
}
