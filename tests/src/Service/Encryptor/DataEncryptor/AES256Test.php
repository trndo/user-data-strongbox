<?php


namespace App\Tests\src\Service\Encryptor\DataEncryptor;


use App\Service\Encryptor\DataEncryptor\AES256;
use App\Service\Encryptor\Exception\HashUnequalException;
use PHPUnit\Framework\TestCase;

class AES256Test extends TestCase
{
    /**
     * @dataProvider providePlainTextAndCryptoKey
     *
     * @param string $plainText
     * @param string $cryptoKey
     * @throws \Exception
     */
    public function testEncrypt(string $plainText, string $cryptoKey): void
    {
        $aes256 = new AES256();

        $encryptedText = $aes256->encrypt($plainText, $cryptoKey);

        $this->assertIsString($encryptedText, 'Is not a string value');
    }

    public function testThrowExceptionIfHashUnequals(): void
    {
        $this->expectException(HashUnequalException::class);

        $aes256 = new AES256();
        $plainText = 'CC567890';
        $cryptoKey = 'qwerty';
        $badCryptoKey = 'asdfgh12';

        $encryptedText = $aes256->encrypt($plainText, $cryptoKey);
        $decryptedText = $aes256->decrypt($encryptedText, $badCryptoKey);
    }

    /**
     * @dataProvider providePlainTextAndCryptoKey
     *
     * @param string $plainText
     * @param string $cryptoKey
     */
    public function testDecrypt(string $plainText, string $cryptoKey): void
    {
        $aes256 = new AES256();

        $encryptedText = $aes256->encrypt($plainText, $cryptoKey);
        $decryptedText = $aes256->decrypt($encryptedText, $cryptoKey);

        $this->assertIsString($decryptedText, 'Is not a string value');
        $this->assertEquals($plainText, $decryptedText);
    }

    public function providePlainTextAndCryptoKey(): array
    {
        return [
            ['CT54545', '12345'],
            ['文字化け', 'passwrd'],
            ['♦️8♦️@♦️>♦️:♦️0♦️O♦️', 'pussycat1345😡']
        ];
    }
}