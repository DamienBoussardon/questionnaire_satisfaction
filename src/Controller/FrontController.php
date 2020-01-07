<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reply;

use App\Entity\PersonSurveyed;

use App\Repository\PersonSurveyedRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{


    private $personSurveyedRepository;

    public function __construct(PersonSurveyedRepository $personSurveyedRepository)
    {
        $this->personSurveyedRepository = $personSurveyedRepository;
    }

    /**
     * @Route(path="/questionnaire_un", name="questionnaire")
     */
    public function responseOfSurvey(Request $request) {
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

    
    public function secondePartOfSurvey(Request $request) {
        $reply = new Reply();
  

         $formBuilderUser = $this->get('form.factory')->createBuilder(FormType::class, $reply);
 
         $formBuilderUser
         ->add('email',      EmailType::class)
         ->add('suivant',      SubmitType::class)
         ;
 
         $form = $formBuilderUser->getForm();
         $form->handleRequest($request);
 
         if (true) {

         }
         else{
             
         }
 
         return $this->render('front_survey/front_survey.html.twig', array(
           'form' => $form->createView(),
         ));
     }


}