<?php

use Deller\QrCode\Factories\QrCodeFactory;
use Deller\QrCode\Types\TextQrCode;
use Deller\QrCode\Types\UrlQrCode;
use Deller\QrCode\Types\WifiQrCode;

it('creates a URL QrCode instance', function () {
    $qrCode = QrCodeFactory::create('url');

    expect($qrCode)->toBeInstanceOf(UrlQrCode::class);
});

it('creates a Text QrCode instance', function () {
    $qrCode = QrCodeFactory::create('text');

    expect($qrCode)->toBeInstanceOf(TextQrCode::class);
});

it('throws an exception for unsupported types', function () {
    expect(fn () => QrCodeFactory::create('unsupported-type'))
        ->toThrow(InvalidArgumentException::class);
});

it('can register a custom type', function () {
    QrCodeFactory::registerType('custom', WifiQrCode::class);

    expect(QrCodeFactory::create('custom'))->toBeInstanceOf(WifiQrCode::class);
});
