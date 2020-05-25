<?php


namespace App\Service\DataPersister\Doctrine;

use App\DataMapper\CreditCardMapper;
use App\Entity\CreditCard;
use App\Model\CreditCardModel;
use App\Service\DataPersister\CreditCardPersisterInterface;
use App\Service\Encryptor\DataEncryptor\AES256;
use App\Service\Encryptor\DataEncryptorHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CreditCardPersister implements CreditCardPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    private $creditCardRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->creditCardRepository = $this->entityManager->getRepository(
            CreditCard::class
        );
    }

    public function save(CreditCardModel $creditCardModel, UserInterface $user): void
    {
        $creditCard = new CreditCard();
        $encryptedModel = $this->encryptData($creditCardModel);

        $creditCard = CreditCardMapper::fromModelToEntity($encryptedModel, $creditCard);
        $creditCard->setUser($user);

        $this->entityManager->persist($creditCard);
        $this->entityManager->flush();
    }

    public function update(
        CreditCardModel $creditCardModel,
        CreditCard $creditCard,
        UserInterface $user
    ): void {
        $encryptedModel = $this->encryptData($creditCardModel);
        $creditCard = CreditCardMapper::fromModelToEntity($encryptedModel, $creditCard);
        $creditCard->setUser($user);

        $this->entityManager->flush();
    }

    public function remove(CreditCard $creditCard): void
    {
        $this->entityManager->remove($creditCard);
        $this->entityManager->flush();
    }

    private function encryptData(CreditCardModel $creditCardModel): CreditCardModel
    {
        $encryptorHandler = new DataEncryptorHandler(new AES256());
        $encryptor = $encryptorHandler->getEncryptor();

        $userKey = $creditCardModel->userKey;
        $data = (array) $creditCardModel;

        foreach ($data as $key => $value) {
            $creditCardModel->$key = $encryptor->encrypt($value, $userKey);
        }

        return $creditCardModel;
    }
}