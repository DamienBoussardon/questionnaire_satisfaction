<?php

namespace App\Controller;

use App\Repository\SurveyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
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
     * @Route(path="/front_survey_page/{id}", name="front_survey_page")
     */
    public function frontSurvey(Request $request, $id)
    {
        $currentSurvey = $this->surveyRepository->find($id);

        return $this->render('front_survey/front_survey.html.twig', ['current_survey' => $currentSurvey]);
    }

    
    public function addResponseToSurvey(){

    } 
    


}