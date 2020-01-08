<?php

namespace App\Form;

use App\Entity\Reply;

use App\Form\PersonSurveyedType;
use App\Repository\FieldSurveyRepository;
use App\Repository\SurveyRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReplyType extends AbstractType
{

    private $surveyRepository;
    private $fieldSurveyRepository;
    
    public function __construct(SurveyRepository $surveyRepository, FieldSurveyRepository $fieldSurveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
        $this->fieldSurveyRepository = $fieldSurveyRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $test = $options['liste_question'];
        // dump($test);

        $builder
            ->add('personSurveyed', PersonSurveyedType::class)
            ->add('mapping_question_response')
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reply::class,
            'liste_question' => [ $this->recoveredFields(1)]
        ]);
    }

    public function recoveredFields($questionnaire){
        $allFieldOfSurvey =  $this->fieldSurveyRepository->findAllFieldSurvayBySurveyId($questionnaire);
        return $allFieldOfSurvey;
    }

    public function recoveredIdOfQuestions($questionnaire){
        $allId = [];
        $allFieldOfSurvey =  $this->fieldSurveyRepository->findAllFieldSurvayBySurveyId($questionnaire);
        foreach ($allFieldOfSurvey as $obj){ 
            array_push($allId ,$obj->getId());
        } 
        return $allId;
    }

   /* public function recoveredQuestion($questionnaire){
        $allQuestion = [];
        $allFieldOfSurvey =  $this->fieldSurveyRepository->findAllFieldSurvayBySurveyId($questionnaire);
        foreach ($allFieldOfSurvey as $obj){ 
            array_push($allQuestion ,$obj->getQuestion());
        } 
        return $allQuestion;
    }*/
}
