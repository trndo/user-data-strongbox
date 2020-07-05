<?php


namespace App\Tests\src\Service\DataPersister\Doctrine;


use App\Entity\CreditCard;
use App\Entity\User;
use App\Model\CreditCardModel;
use App\Service\DataPersister\Doctrine\CreditCardPersister;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CreditCardPersisterTest extends TestCase
{
    public function testSave(): void
    {
        $emStub = $this->createMock(EntityManagerInterface::class);
        $user = new User();

        $emStub->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(CreditCard::class));

        $emStub->expects($this->once())
            ->method('flush');

        $creditCardDataPersister = new CreditCardPersister($emStub);
        $creditCardDataPersister->save($this->getTestCreditCardModel(), $user);
    }

    private function getTestCreditCardModel(): CreditCardModel
    {
        $creditCardModel = new CreditCardModel();
        $creditCardModel->userKey = '1234567';
        $creditCardModel->paymentNumber = '1234534654645';
        $creditCardModel->cardVerificationCode = '345';
        $creditCardModel->passPhrase = 'catdog';
        $creditCardModel->expirationDate = '12/22';
        $creditCardModel->password = 'garilgatch';

        return $creditCardModel;
    }
}