<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GeneralController extends AbstractController
{

    /**
     * @Route(path="/", name="home")
     * @return Response
     */
    public function index(Request $request): Response
    {       
      $response = new Response();
            $response->headers->setCookie(Cookie::create('acceptCookie', 'false'));
            echo ($response);
            return $this->render('pages/home.html.twig');
    }


      /**
     * @Route(path="/plateforme/dashboard", name="dashboard")
     * @return Response
     */
    public function statisticalDashoard(): Response
    {
          return $this->render('pages/dashboard.html.twig');
    }

      /**
     * @Route(path="/cookies_policy", name="cookies_policy")
     * @return Response
     */
    public function showCookiesPolicy(): Response
    {
          return $this->render('pages/cookies_policy.html.twig');
    }

      /**
     * @Route(path="/personal_data_charter", name="personal_data_charter")
     * @return Response
     */
    public function showPersonalDataCharter(): Response
    {
          return $this->render('pages/personal_data_charter.html.twig');
    }

      /**
     * @Route(path="/terms_service", name="terms_service")
     * @return Response
     */
    public function showTermsService(): Response
    {
          return $this->render('pages/terms_service.html.twig');
    }

      /**
     * @Route(path="/legales_mentions", name="legales_mentions")
     * @return Response
     */
    public function showLegalesMention(): Response
    {
          return $this->render('pages/legales_mentions.html.twig');
    }

      /**
     * @Route(path="/general_condition", name="general_condition")
     * @return Response
     */
    public function showGeneralCondition(): Response
    {
          return $this->render('pages/general_condition.html.twig');
    }


}
