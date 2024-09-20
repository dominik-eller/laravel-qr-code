<?php

namespace Deller\QrCode\Types;

use Deller\QrCode\QrCode;

class TextQrCode extends QrCode
{
    protected $text;

    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    public function getData(): string
    {
        return $this->text;
    }
}
