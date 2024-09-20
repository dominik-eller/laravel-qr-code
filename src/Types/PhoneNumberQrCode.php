<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

/**
 * Class PhoneNumberQrCode
 *
 * This class is responsible for generating a QR code that encodes a phone number.
 * It extends the base `QrCode` class and provides functionality to set a phone number
 * and return the corresponding `tel:` link for QR code generation.
 */
class PhoneNumberQrCode extends QrCode
{
    /**
     * The phone number to be encoded into the QR code.
     *
     * @var string
     */
    protected string $phoneNumber;

    /**
     * Set the phone number for the QR code.
     *
     * This method sets the phone number that will be encoded into the QR code.
     *
     * @param string $phoneNumber The phone number to encode in the QR code.
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
     * This method returns the `tel:` link that will be encoded into the QR code.
     * It formats the phone number as a `tel:` link, which can be scanned by devices to dial the phone number directly.
     *
     * @return string The formatted `tel:` link (e.g., tel:+123456789).
     */
    public function getData(): string
    {
        return 'tel:' . $this->phoneNumber;
    }
}
