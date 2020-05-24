<?php


namespace App\Service\DataProvider\Doctrine;


use App\Entity\User;
use App\Repository\CreditCardRepository;
use App\Service\DataProvider\CreditCardProviderInterface;

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

    public function getCreditCards(User $user): ?array
    {
        return $this->creditCardRepository->findAllByUser($user);
    }
}