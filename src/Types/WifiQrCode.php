<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

/**
 * Class WifiQrCode
 *
 * This class is responsible for generating a QR code that encodes WiFi network credentials.
 * It extends the base `QrCode` class and provides functionality to set the SSID, password,
 * and encryption type, and returns the properly formatted WiFi data for QR code generation.
 */
class WifiQrCode extends QrCode
{
    /**
     * The SSID (network name) of the WiFi network.
     *
     * @var string
     */
    protected string $ssid;

    /**
     * The password of the WiFi network.
     *
     * @var string
     */
    protected string $password;

    /**
     * The encryption type used by the WiFi network (e.g., WPA, WEP, or nopass).
     *
     * @var string
     */
    protected string $encryption;

    /**
     * Set the SSID (network name) for the QR code.
     *
     * @param string $ssid The SSID of the WiFi network.
     * @return $this
     */
    public function setSsid(string $ssid)
    {
        $this->ssid = $ssid;

        return $this;
    }

    /**
     * Set the password for the QR code.
     *
     * @param string $password The password of the WiFi network.
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the encryption type for the WiFi network.
     *
     * Common encryption types are `WPA`, `WEP`, or `nopass` for open networks.
     *
     * @param string $encryption The encryption type of the WiFi network.
     * @return $this
     */
    public function setEncryption(string $encryption)
    {
        $this->encryption = $encryption;

        return $this;
    }

    /**
     * Return the formatted WiFi network data for the QR code.
     *
     * This method formats the WiFi network credentials into a string that conforms
     * to the standard `WIFI:` format for QR codes. The string will be structured as:
     * `WIFI:S:<SSID>;T:<Encryption>;P:<Password>;;`
     *
     * @return string The formatted WiFi QR code data.
     */
    public function getData(): string
    {
        return "WIFI:S:{$this->ssid};T:{$this->encryption};P:{$this->password};;";
    }
}
