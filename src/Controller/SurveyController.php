<?php

namespace App\Controller;

use App\Form\SurveyType;
use App\Entity\Survey;
use App\Form\FieldSurveyType;
use App\Entity\FieldSurvey;
use App\Repository\SurveyRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SurveyController extends AbstractController
{
    /**
    * @var SurveyRepository
    */
    private $surveyRepository;

    public function __construct(SurveyRepository $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    /**
     * @Route(path="/admin/survey", name="survey", methods="GET")
     * @return Response
     */
    public function index(): Response
    {
        $surveys = $this->surveyRepository->findAll();

        return $this->render('survey/index.html.twig',['surveys' => $surveys]);
    

    }

    /**
     * @Route(path="/admin/create_survey_page", name="create_survey_page")
     */
    public function formCreationSurvey(Request $request)
    {

            $survey = new Survey();
            $form = $this->createForm(SurveyType::class, $survey);
  
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($survey);
                $em->flush();
                return $this->redirectToRoute('show_survey_page', ['id' => $survey->getId()]);
            }
            return $this->render('survey/form.html.twig', array(
                'form' => $form->createView(),
            ));
            
    }

     /**
     * @Route(path="/admin/{id}/edit_survey_page", name="edit_survey_page")
     */
    public function formCreationFieldSurvey(Request $request, $id)
    {
        $currentSurvey = $this->surveyRepository->find($id);
        
        $fieldSurvey = new FieldSurvey();
        $fieldSurvey->setSurvey($currentSurvey);
        dump($fieldSurvey);
        $form = $this->createForm(FieldSurveyType::class, $fieldSurvey,['current_survey' => $currentSurvey]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fieldSurvey);
            $em->flush();

            return $this->redirectToRoute('survey');
        }
    
        return $this->render('field_survey/edit.html.twig', array(
            'form' => $form->createView(),
        ));

    }


     /**
     * @Route(path="/admin/delete_survey_page/{survey}/", name="delete_survey_page")
     */
    public function deleteSurvey($survey)
    { 
        dump($survey);
        $id = $survey->id();
        $currentSurvey = $this->surveyRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($currentSurvey);
        $entityManager->flush();

    
        return $this->redirectToRoute('survey');
    }

      /**
     * @Route(path="/admin/{id}/show_survey_page", name="show_survey_page")
     */
    public function  showSurvey(Request $request, $id)
    {
        $currentSurvey = $this->surveyRepository->find($id);

    
        return $this->render('survey/show.html.twig', ['current_survey' => $currentSurvey]);
    
    }


}
