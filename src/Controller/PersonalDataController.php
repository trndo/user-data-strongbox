<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalDataController
{
    /**
     * @Route("/profile/personal-data", name="personal_data_index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('credit_card/index.html.twig');
    }
}