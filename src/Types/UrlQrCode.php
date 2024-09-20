<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

class UrlQrCode extends QrCode
{
    protected $url;

    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function getData(): string
    {
        return $this->url;
    }
}
