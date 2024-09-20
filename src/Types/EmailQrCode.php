<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

class EmailQrCode extends QrCode
{
    protected $email;

    /**
     * Set the email address for the QR code.
     *
     * @param string $email
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
     * @return string
     */
    public function getData(): string
    {
        return "mailto:" . $this->email;
    }
}
