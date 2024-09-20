<?php

use Deller\QrCode\Types\WifiQrCode;

it('sets the wifi correctly', function () {
    $qrCode = new WifiQrCode;
    $qrCode->setSsid('Some SSID');
    $qrCode->setEncryption('WPA');
    $qrCode->setPassword('password');

    expect($qrCode->getData())->toBe('WIFI:S:Some SSID;T:WPA;P:password;;');
});
