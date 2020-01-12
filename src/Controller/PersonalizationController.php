<?php

namespace App\Controller;

use App\Entity\Personalization;
use App\Form\PersonalizationType;
use App\Repository\PersonalizationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PersonalizationController extends AbstractController
{

    /**
    * @var PersonalizationRepository
    */
    private $personalizationRepository;

    public function __construct(PersonalizationRepository $personalizationRepository)
    {
        $this->personalizationRepository = $personalizationRepository;
    }


    /**
     * @Route(path="/admin/personalisation", name="personalization")
     */
    public function editPersonalization(Request $request)
    {
        $user = $this->getUser();  
 
        $personalization = $this->personalizationRepository->findPersonalizationByUserId($user->getId());

        dump($personalization);
        if( $personalization == null ){
            $personalization = new Personalization($user);
            $personalization->setUser($user);
        }
        

        $form = $this->createForm(PersonalizationType::class,$personalization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            dump($personalization);
            $entityManager->persist($personalization);
            $entityManager->flush();

            return $this->redirectToRoute('survey');
        }

        return $this->render('personalization/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}