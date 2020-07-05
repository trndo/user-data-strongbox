<?php


namespace App\Tests\src\Service\DataProvider\Doctrine;


use App\Entity\CreditCard;
use App\Model\CreditCardModel;
use App\Repository\CreditCardRepository;
use App\Service\DataProvider\Doctrine\CreditCardProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreditCardProviderTest extends KernelTestCase
{
    private $creditCardRepository;

    public function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->creditCardRepository = $kernel->getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(CreditCard::class);
    }

    public function testGetCreditCardModel(): void
    {
        $creditCard = $this->creditCardRepository->find(2);
        $creditCardProvider = new CreditCardProvider($this->creditCardRepository);

        $result = $creditCardProvider->getCreditCardModel($creditCard, 'qwerty12');

        $this->assertInstanceOf(CreditCardModel::class, $result);
        $this->assertNull($result->userKey);
        $this->assertSame('4444444444444444', $result->paymentNumber);
        $this->assertSame('catdog', $result->passPhrase);
    }

    public function tearDown(): void
    {
        $this->creditCardRepository = null;
    }

}