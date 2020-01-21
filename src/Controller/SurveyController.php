<?php

namespace App\Controller;

use App\Form\SurveyType;
use App\Form\FieldSurveyType;
use App\Entity\FieldSurvey;
use App\Entity\Survey;
use App\Repository\SurveyRepository;
use App\Service\HashGenerator;
use App\Service\CustomUserEntry;

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
    private $hashGenerator;

    public function __construct(SurveyRepository $surveyRepository, HashGenerator $hashGenerator, CustomUserEntry $customUserEntry)
    {
        $this->surveyRepository = $surveyRepository;
        $this->hashGenerator = $hashGenerator;
        $this->customUserEntry = $customUserEntry;
    }

    /**
     * @Route(path="/plateforme/surveys", name="surveys")
     * @return Response
     */
    public function show(): Response
    {

        $user_id = $this->getUser()->getId();
        $surveys = $this->surveyRepository->findSurveysByUserId($user_id);

        return $this->render('survey/show.html.twig',['surveys' => $surveys]);

    }

          /**
     * @Route(path="/plateforme/surveys/{id}", name="survey")
     */
    public function  index(Request $request, $id)
    {
        $currentSurvey = $this->surveyRepository->find($id);

        return $this->render('survey/index.html.twig', ['current_survey' => $currentSurvey]);
    
    }

    /**
     * @Route(path="/plateforme/create_survey_page", name="create_survey_page")
     */
    public function formCreationSurvey(Request $request)
    {
            $user = $this->getUser();

            $survey = new Survey($user);
            $form = $this->createForm(SurveyType::class, $survey);
            $hash = $this->hashGenerator->getHash();
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $survey->setHashIdentifier($hash);
                $em = $this->getDoctrine()->getManager();
                $em->persist($survey);
                $em->flush();
                return $this->redirectToRoute('survey', ['id' => $survey->getId()]);
            }
            return $this->render('survey/form.html.twig', array(
                'form' => $form->createView(),
            ));
            
    }

    /**
     * @Route(path="/plateforme/delete_survey_page/{id}/", name="delete_survey_page")
     */
    public function deleteSurvey($id)
    { 
       
        $currentSurvey = $this->surveyRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($currentSurvey);
        $entityManager->flush();

    
        return $this->redirectToRoute('surveys');
    }

     /**
     * @Route(path="/plateforme/edit_survey_page/{id}", name="edit_survey_page")
     */
    public function formCreationFieldSurvey(Request $request, $id)
    {
        $fieldSurvey = new FieldSurvey();
        $associatedValues = null;
        $currentSurvey = $this->surveyRepository->find($id);
        $contentForm = $request->request->all();


        if($contentForm != null){
        
            $question = $contentForm["field_survey"]["question"];
            $questionCustomize = $this->customUserEntry->customNameOfQuestion($question);
            $fieldSurvey->setQuestion($questionCustomize);
            
            if(isset($contentForm["_associated_values"]) && $contentForm["_associated_values"] != null){
                $associatedValues​​NotProcessed = explode(",", $contentForm["_associated_values"]);
                $associatedValues = $this->customUserEntry->customCollectionOfAssociatedValue($associatedValues​​NotProcessed);
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

            return $this->redirectToRoute('survey',  array('id' => $currentSurvey->getId()));
        }
    
        return $this->render('field_survey/edit.html.twig', array(
            'form' => $form->createView(),
        ));

    }

 




}
