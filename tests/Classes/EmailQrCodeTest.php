<?php

use Deller\QrCode\Types\EmailQrCode;

it('sets the email correctly', function () {
    $qrCode = new EmailQrCode;
    $qrCode->setEmail('test@example.com');

    expect($qrCode->getData())->toBe('mailto:test@example.com');
});
