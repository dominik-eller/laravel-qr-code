<?php

use Deller\QrCode\Types\PhoneNumberQrCode;

it('sets the phone number correctly', function () {
    $qrCode = new PhoneNumberQrCode();
    $qrCode->setPhoneNumber('+123456789');

    expect($qrCode->getData())->toBe('tel:+123456789');
});
