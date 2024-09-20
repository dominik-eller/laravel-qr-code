<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

/**
 * Class EmailQrCode
 *
 * This class is responsible for generating a QR code that encodes an email address.
 * It extends the base `QrCode` class and provides the necessary functionality to set an email address
 * and return the corresponding mailto link for QR code generation.
 */
class EmailQrCode extends QrCode
{
    /**
     * The email address to be encoded into the QR code.
     *
     * @var string
     */
    protected string $email;

    /**
     * Set the email address for the QR code.
     *
     * This method sets the email address that will be encoded into the QR code.
     *
     * @param string $email The email address to encode in the QR code.
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Return the formatted email data for the QR code.
     *
     * This method returns the `mailto:` link that will be encoded into the QR code.
     * It formats the email address as a mailto link, which can be scanned by devices to open an email client.
     *
     * @return string The formatted mailto link (e.g., mailto:example@example.com).
     */
    public function getData(): string
    {
        return 'mailto:' . $this->email;
    }
}
