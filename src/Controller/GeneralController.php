<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class GeneralController extends AbstractController
{

    /**
     * @Route(path="/", name="home")
     * @return Response
     */
    public function index(): Response
    {
          return $this->render('pages/home.html.twig');
    }


      /**
     * @Route(path="/dashboard", name="dashboard")
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

}
