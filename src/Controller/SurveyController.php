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

        $user_id = $this->getUser()->getId();
        $surveys = $this->surveyRepository->findSurveyByUserId($user_id);

        return $this->render('survey/index.html.twig',['surveys' => $surveys]);

    }

    /**
     * @Route(path="/admin/create_survey_page", name="create_survey_page")
     */
    public function formCreationSurvey(Request $request)
    {
            $user = $this->getUser();

            $survey = new Survey($user);
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
     * @Route(path="/admin/edit_survey_page/{id}", name="edit_survey_page")
     */
    public function formCreationFieldSurvey(Request $request, $id)
    {
        $currentSurvey = $this->surveyRepository->find($id);

        $associatedValues = null;
        
        $fieldSurvey = new FieldSurvey();

        $contentForm = $request->request->all();

        if($contentForm != null){
            if(isset($contentForm["_radio_value"]) && $contentForm["_radio_value"] != null){
                $associatedValues​​NotProcessed = explode(",", $contentForm["_radio_value"]);
                $associatedValues = array_map('trim', $associatedValues​​NotProcessed);
            }
            if(isset($contentForm["_checkbox_value"]) && $contentForm["_checkbox_value"] != null){
                $associatedValues​​NotProcessed = explode(",", $contentForm["_checkbox_value"]);
                $associatedValues = array_map('trim', $associatedValues​​NotProcessed);
            }
            if(isset($contentForm["_select_value"]) && $contentForm["_select_value"] != null){
                $associatedValues​​NotProcessed = explode(",", $contentForm["_select_value"]);
                $associatedValues = array_map('trim', $associatedValues​​NotProcessed);
            }
        }
       
        $form = $this->createForm(FieldSurveyType::class,$fieldSurvey);
        $form->handleRequest($request);

     
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $fieldSurvey->setSurvey($currentSurvey);
            $fieldSurvey->setAssociatedValues($associatedValues);
            $em->persist($fieldSurvey);
            $em->flush();

            return $this->redirectToRoute('survey');
        }
    
        return $this->render('field_survey/edit.html.twig', array(
            'form' => $form->createView(),
        ));

    }

     /**
     * @Route(path="/admin/delete_survey_page/{id}/", name="delete_survey_page")
     */
    public function deleteSurvey($id)
    { 
       
        $currentSurvey = $this->surveyRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($currentSurvey);
        $entityManager->flush();

    
        return $this->redirectToRoute('survey');
    }

      /**
     * @Route(path="/admin/show_survey_page/{id}", name="show_survey_page")
     */
    public function  showSurvey(Request $request, $id)
    {
        $currentSurvey = $this->surveyRepository->find($id);

        return $this->render('survey/show.html.twig', ['current_survey' => $currentSurvey]);
    
    }


}
