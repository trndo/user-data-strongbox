<?php


namespace App\Controller;


use App\Entity\CreditCard;
use App\Form\CreditCardType;
use App\Model\CreditCardModel;
use App\Service\DataPersister\CreditCardPersisterInterface;
use App\Service\DataProvider\CreditCardProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/profile/credit-card/create", name="credit_card_create")
     * @param Request $request
     * @param CreditCardPersisterInterface $creditCardPersister
     * @return Response
     */
    public function create(
        Request $request,
        CreditCardPersisterInterface $creditCardPersister
    ): Response {
        $form = $this->createForm(CreditCardType::class, new CreditCardModel());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $creditCardPersister->save($form->getData(), $this->getUser());

            return $this->redirectToRoute('credit_card_index');
        }

        return $this->render('credit_card/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile/credit-card/edit/{creditCard}", name="credit_card_edit")
     * @param Request $request
     * @param CreditCard $creditCard
     * @param CreditCardPersisterInterface $creditCardPersister
     * @param CreditCardProviderInterface $creditCardProvider
     * @return Response
     */
    public function edit(
        Request $request,
        CreditCard $creditCard,
        CreditCardPersisterInterface $creditCardPersister,
        CreditCardProviderInterface $creditCardProvider
    ): Response {
        $userKey = $request->getSession()->get('userKey');

        if (!$userKey) {
            return $this->redirectToRoute('key_set');
        }

        $model = $creditCardProvider->getCreditCardModel($creditCard, $userKey);
        $form = $this->createForm(CreditCardType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $creditCardPersister->update($form->getData(), $creditCard, $this->getUser());

            return $this->redirectToRoute('credit_card_index');
        }

        return $this->render('credit_card/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile/credit-card/delete/{CreditCard}", name="credit_card_delete")
     * @param CreditCard $creditCard
     * @param CreditCardPersisterInterface $creditCardPersister
     * @return RedirectResponse
     */
    public function delete(
        CreditCard $creditCard,
        CreditCardPersisterInterface $creditCardPersister
    ): RedirectResponse {
        $creditCardPersister->remove($creditCard);

        return $this->redirectToRoute('credit_card_index');
    }
}