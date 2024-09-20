<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

/**
 * Class TextQrCode
 *
 * This class is responsible for generating a QR code that encodes plain text.
 * It extends the base `QrCode` class and provides functionality to set the text
 * and return the raw text data for QR code generation.
 */
class TextQrCode extends QrCode
{
    /**
     * The plain text to be encoded into the QR code.
     */
    protected string $text;

    /**
     * Set the text to encode in the QR code.
     *
     * This method sets the plain text that will be encoded into the QR code.
     *
     * @param  string  $text  The text to encode in the QR code.
     * @return $this
     */
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Return the raw text data for the QR code.
     *
     * This method returns the plain text that will be encoded into the QR code.
     *
     * @return string The raw text to be encoded.
     */
    public function getData(): string
    {
        return $this->text;
    }
}
