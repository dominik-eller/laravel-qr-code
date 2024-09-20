<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

class WifiQrCode extends QrCode
{
    protected $ssid;

    protected $password;

    protected $encryption;

    public function setSsid(string $ssid)
    {
        $this->ssid = $ssid;

        return $this;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function setEncryption(string $encryption)
    {
        $this->encryption = $encryption;

        return $this;
    }

    public function getData(): string
    {
        return "WIFI:S:{$this->ssid};T:{$this->encryption};P:{$this->password};;";
    }
}
