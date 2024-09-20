<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

class PhoneNumberQrCode extends QrCode
{
    protected $phoneNumber;

    /**
     * Set the phone number for the QR code.
     *
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Return the formatted phone number data for the QR code.
     *
     * @return string
     */
    public function getData(): string
    {
        return "tel:" . $this->phoneNumber;
    }
}
