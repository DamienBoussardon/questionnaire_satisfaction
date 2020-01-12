<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;


use App\Entity\Reply;

use App\Entity\PersonSurveyed;
use App\Repository\SurveyRepository;
use App\Repository\FieldSurveyRepository;
use App\Repository\PersonSurveyedRepository;
use App\Repository\ReplyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FrontController extends AbstractController
{


  private $personSurveyedRepository;
  private $surveyRepository;
  private $fieldSurveyRepository;
  private $replyRepository;

  public function __construct(
                              PersonSurveyedRepository $personSurveyedRepository, 
                              SurveyRepository $surveyRepository, 
                              FieldSurveyRepository $fieldSurveyRepository,
                              ReplyRepository $replyRepository)
  {
      $this->personSurveyedRepository = $personSurveyedRepository;
      $this->surveyRepository = $surveyRepository;
      $this->fieldSurveyRepository = $fieldSurveyRepository;
      $this->replyRepository = $replyRepository;
  }
  


    /**
     * @Route(path="/questionnaire_{id}", name="questionnaire")
    */
    public function responseOfSurvey(Request $request, $id) {
        
      $survey =  $this->surveyRepository->find($id);
      $fields =  $this->fieldSurveyRepository->findAllFieldSurvayBySurveyId($survey->getId());
      $content = $request->request->all();;

      if($content != null){
        $this->valueTraitement($content , $fields ,$survey);
      }
  
      return $this->render('front_survey/front_survey.html.twig', array(
        'list_field' => $fields,
        'survey' => $survey
      ));


    }
      
    public function valueTraitement($data, $fields, $survey) {

        $entityManager = $this->getDoctrine()->getManager();

        $mapping = [];

        $emailOfPersonSurveyed = $data['_email'];

        if ($emailOfPersonSurveyed != null){

          $personSurveyedExist = $this->personSurveyedRepository->findOneByEmail($emailOfPersonSurveyed);

          dump( $personSurveyedExist);
        
    
          if ( $personSurveyedExist == null){
              $personSurveyed = new PersonSurveyed();
              $personSurveyed->setEmail($emailOfPersonSurveyed);
              $entityManager->persist($personSurveyed);
              $entityManager->flush();
              $idOfPersonSurveyed = $personSurveyed->getId();
              dump( $idOfPersonSurveyed);
          }else{
            $idOfPersonSurveyed  = $personSurveyedExist->getId();
            dump( $idOfPersonSurveyed);
          }
          
          $personSurveyed = $this->personSurveyedRepository->find($idOfPersonSurveyed);

          $alreadyAnswered = $this->replyRepository->findReplyBySurveyAndPersonSurveyed($survey, $personSurveyed);

          dump($alreadyAnswered);

          if ( $alreadyAnswered == null ){

            foreach($fields as $field ){
              // verifie si $field != null et l'ajout a l'array $mapping
              if( $data[$field->getId()] != null ){
                array_push($mapping, [ $field->getId() => $data[$field->getId()] ] );
              }
            }
  
             // verifie si  l'ensemble des $field sont remplit et persist la $reply
            if( sizeof($fields) == sizeof($mapping)){
              $reply = new Reply();
        
              $reply->setPersonSurveyed($personSurveyed );
              $reply->setSurvey($survey);
              $reply->setCreatedAt(new DateTime('now', new DateTimeZone('Europe/Paris') ));
              $reply->setMappingQuestionResponse($mapping); 
    
              $reply->setIsCompleted(true);
              $entityManager->persist($reply);
              $entityManager->flush();
            
            }else{
              $this->addFlash('messageError',"Vous n'avez pas complété l'ensemble du formulaire" );
            }
          }else{
            $this->addFlash('messageError',"Vous avez déja complété ce formulaire" );
          }
          
       }else{
        $this->addFlash('messageError',"Vous n'avez pas renseigné votre adresse email" );
       }
    }


}