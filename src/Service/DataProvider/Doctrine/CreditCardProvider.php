<?php


namespace App\Service\DataProvider\Doctrine;

use App\DataMapper\CreditCardMapper;
use App\Entity\CreditCard;
use App\Model\CreditCardModel;
use App\Repository\CreditCardRepository;
use App\Service\DataProvider\CreditCardProviderInterface;
use App\Service\Encryptor\DataEncryptor\AES256;
use App\Service\Encryptor\DataEncryptorHandler;
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

    public function getCreditCardModel(CreditCard $creditCard, string $userKey): CreditCardModel
    {
        $encryptorHandler = new DataEncryptorHandler(new AES256());
        $encryptor = $encryptorHandler->getEncryptor();

        $personalDataModel = CreditCardMapper::fromEntityToModel($creditCard);
        $data = (array) $personalDataModel;
        unset($data['userKey']);

        foreach ($data as $key => $value) {
            $personalDataModel->$key = $encryptor->decrypt($value, $userKey);
        }

        return $personalDataModel;
    }
}