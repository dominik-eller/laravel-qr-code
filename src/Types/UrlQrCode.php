<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

/**
 * Class UrlQrCode
 *
 * This class is responsible for generating a QR code that encodes a URL.
 * It extends the base `QrCode` class and provides functionality to set a URL
 * and return the corresponding URL data for QR code generation.
 */
class UrlQrCode extends QrCode
{
    /**
     * The URL to be encoded into the QR code.
     */
    protected string $url;

    /**
     * Set the URL to encode in the QR code.
     *
     * This method sets the URL that will be encoded into the QR code.
     *
     * @param  string  $url  The URL to encode in the QR code.
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Return the URL data for the QR code.
     *
     * This method returns the URL that will be encoded into the QR code.
     *
     * @return string The URL to be encoded.
     */
    public function getData(): string
    {
        return $this->url;
    }
}
