<?php


namespace App\Service\DataProvider\Doctrine;

use App\Entity\CreditCard;
use App\Model\CreditCardModel;
use App\Repository\CreditCardRepository;
use App\Service\DataProvider\CreditCardProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CreditCardProvider implements CreditCardProviderInterface
{
    /**
     * @var CreditCardRepository
     */
    private CreditCardRepository $creditCardRepository;

    public function __construct(CreditCardRepository $creditCardRepository)
    {
        $this->creditCardRepository = $creditCardRepository;
    }

    public function getCreditCards(UserInterface $user): ?array
    {
        return $this->creditCardRepository->findAllByUser($user);
    }

    public function getCreditCardModel(CreditCard $creditCard): CreditCardModel
    {
        // TODO: Implement getCreditCardModel() method.
    }
}