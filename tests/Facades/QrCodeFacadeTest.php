<?php

use Deller\QrCode\Facades\QrCode;
use Deller\QrCode\Factories\QrCodeFactory;

it('resolves to QrCodeFactory instance', function () {
    $facade = QrCode::getFacadeRoot();

    expect($facade)->toBeInstanceOf(QrCodeFactory::class);
});
