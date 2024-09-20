<?php

use BaconQrCode\Common\ErrorCorrectionLevel;
use Deller\QrCode\Types\UrlQrCode;

it('sets the size correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setSize(400);

    expect($qrCode->getSize())->toBe(400);
});

it('sets the color correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setColor([0, 0, 255]);

    expect($qrCode->getColor())->toBe([0, 0, 255]);
});

it('sets the background color correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setBackgroundColor([255, 255, 0]);

    expect($qrCode->getBackgroundColor())->toBe([255, 255, 0]);
});

it('sets the error correction level h', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::H());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::H());
});

it('sets the error correction level l', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::L());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::L());
});

it('sets the error correction level q', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::Q());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::Q());
});

it('trhows an execption if the error correction level is nnot existing', function () {
    $qrCode = new UrlQrCode();

    expect(fn () => $qrCode->setErrorCorrectionLevel('F'))
        ->toThrow(InvalidArgumentException::class);
});

it('sets the error correction level m', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::M());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::M());
});

it('sets the url data correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setUrl('https://www.example.com');

    expect($qrCode->getData())->toBe('https://www.example.com');
});

it('sets the margin correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setMargin(100);

    expect($qrCode->getMargin())->toBe(100);
});

it('sets the top right eye color correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setTopRightEyeColor([255,255,255]);

    expect($qrCode->getTopRightEyeColor())->toBe([255,255,255]);
});

it('sets the top left eye color correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setTopLeftEyeColor([255,255,255]);

    expect($qrCode->getTopLeftEyeColor())->toBe([255,255,255]);
});

it('sets the bottom left eye color correctly', function () {
    $qrCode = new UrlQrCode();
    $qrCode->setBottomLeftEyeColor([255,255,255]);

    expect($qrCode->getBottomLeftEyeColor())->toBe([255,255,255]);
});

it('generates correct qr code', function() {
    $qrCode = new UrlQrCode();
    $qrCode->setUrl('https://example.com');

    $result = $qrCode->generate();

    expect($result)->toBeString();
});

it('constructs with correct defaults', function () {
    $qrCode = new UrlQrCode();

    expect($qrCode->getSize())->toBe(300);
    expect($qrCode->getColor())->toBe([0, 0, 0]);
    expect($qrCode->getBackgroundColor())->toBe([255, 255, 255]);
    expect($qrCode->getMargin())->toBe(10);
    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::M());
    expect($qrCode->getTopLeftEyeColor())->toBe([0, 0, 0]);
    expect($qrCode->getTopRightEyeColor())->toBe([0, 0, 0]);
    expect($qrCode->getBottomLeftEyeColor())->toBe([0, 0, 0]);
});
