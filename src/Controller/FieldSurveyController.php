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
     * @Route(path="/admin/delete_field/{id}", name="delete_field")
     */
    public function deleteField($id)
    {
        $currentField = $this->fieldSurveyRepository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($currentField);
        $entityManager->flush();

    
        return $this->redirectToRoute('survey');
    }

}