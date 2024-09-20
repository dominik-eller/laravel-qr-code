<?php

use Deller\QrCode\Types\TextQrCode;

it('sets the text correctly', function () {
    $qrCode = new TextQrCode;
    $qrCode->setText('Hello World');

    expect($qrCode->getData())->toBe('Hello World');
});
