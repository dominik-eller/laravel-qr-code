<?php

use Deller\QrCode\Types\UrlQrCode;

it('sets the URL correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setUrl('https://example.com');

    expect($qrCode->getData())->toBe('https://example.com');
});
