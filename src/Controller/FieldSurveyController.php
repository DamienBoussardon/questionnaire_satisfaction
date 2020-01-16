<?php

namespace App\Controller;

use App\Entity\FieldSurvey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FieldSurveyRepository;


class FieldSurveyController extends AbstractController
{

    /**
    * @var FieldSurveyRepository
    */
    private $fieldSurveyRepository;

    public function __construct(FieldSurveyRepository $fieldSurveyRepository)
    {
        $this->fieldSurveyRepository = $fieldSurveyRepository;
    }


    /**
     * @Route(path="/plateforme/delete_field/{id}", name="delete_field")
     */
    public function deleteField($id)
    {
        $currentField = $this->fieldSurveyRepository->find($id);
        $currentSurvey = $currentField->getSurvey(); 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($currentField);
        $entityManager->flush();

    
        return $this->redirectToRoute('survey',  array('id' => $currentSurvey->getId()));
    }

}