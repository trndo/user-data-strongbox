<?php


namespace App\Model;


class PersonalDataModel
{
    private ?string $passportCode;

    private ?string $taxIdentificationNumber;

    /**
     * @return string|null
     */
    public function getPassportCode(): ?string
    {
        return $this->passportCode;
    }

    /**
     * @param string|null $passportCode
     * @return PersonalDataModel
     */
    public function setPassportCode(?string $passportCode): PersonalDataModel
    {
        $this->passportCode = $passportCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxIdentificationNumber(): ?string
    {
        return $this->taxIdentificationNumber;
    }

    /**
     * @param string|null $taxIdentificationNumber
     * @return PersonalDataModel
     */
    public function setTaxIdentificationNumber(?string $taxIdentificationNumber): PersonalDataModel
    {
        $this->taxIdentificationNumber = $taxIdentificationNumber;
        return $this;
    }
}