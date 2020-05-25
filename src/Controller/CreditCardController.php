<?php


namespace App\Controller;


use App\Service\DataProvider\CreditCardProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreditCardController extends AbstractController
{
    /**
     * @Route("/profile/credit-card", name="credit_card_index")
     * @param CreditCardProviderInterface $creditCardProvider
     * @return Response
     */
    public function index(CreditCardProviderInterface $creditCardProvider): Response
    {
        $user = $this->getUser();
        $creditCards = $creditCardProvider->getCreditCards($user);

        return $this->render('credit_card/index.html.twig', [
            'creditCards' => $creditCards
        ]);
    }


}