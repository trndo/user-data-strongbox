<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreditCardController extends AbstractController
{
    /**
     * @Route("/profile/credit-card", name="credit_card_index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('credit_card/index.html.twig');
    }
}