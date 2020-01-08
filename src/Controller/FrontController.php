<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reply;

use App\Form\ReplyType;
use App\Entity\PersonSurveyed;
use App\Repository\SurveyRepository;
use App\Repository\PersonSurveyedRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Intl\DateFormatter\DateFormat\SecondTransformer;

class FrontController extends AbstractController
{


    private $personSurveyedRepository;
    private $surveyRepository;

    public function __construct(PersonSurveyedRepository $personSurveyedRepository, SurveyRepository $surveyRepository)
    {
        $this->personSurveyedRepository = $personSurveyedRepository;
        $this->surveyRepository = $surveyRepository;
    }
  


      /**
     * @Route(path="/questionnaire_un", name="questionnaire")
     */
    public function responseOfSurvey(Request $request) {
      
      $survey =  $this->surveyRepository->find(1);

      $reply = new Reply();
      $form = $this->createForm(ReplyType::class, $reply);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $reply->setSurvey($survey);
          $em->persist($reply);
          $em->flush();
      }
      return $this->render('front_survey/front_survey.html.twig', array(
          'form' => $form->createView(),
      ));
    }
      
      public function test(Request $request) {
        /* $response = new Response();*/
  
         $personSurveyed = new PersonSurveyed();
 
         $formBuilderPersonSurveyed = $this->get('form.factory')->createBuilder(FormType::class, $personSurveyed);
 
         $formBuilderPersonSurveyed
           ->add('email',      EmailType::class)
           ->add('suivant',      SubmitType::class)
         ;
 
         $form = $formBuilderPersonSurveyed->getForm();
         $form->handleRequest($request);
 
         $email = $personSurveyed->getEmail();
 
         $existe = $this->personSurveyedRepository->findOneByEmail($email);
 
         if ($form->isSubmitted() && $form->isValid() && !$existe) {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($personSurveyed);
             $entityManager->flush();
         }
 
         return $this->render('front_survey/front_survey.html.twig', array(
           'form' => $form->createView(),
         ));
     }
 
}