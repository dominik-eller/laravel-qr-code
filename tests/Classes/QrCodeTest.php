<?php

use BaconQrCode\Common\ErrorCorrectionLevel;
use Deller\QrCode\Types\UrlQrCode;

it('sets the size correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setSize(400);

    expect($qrCode->getSize())->toBe(400);
});

it('sets the color correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setColor([0, 0, 255]);

    expect($qrCode->getColor())->toBe([0, 0, 255]);
});

it('sets the background color correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setBackgroundColor([255, 255, 0]);

    expect($qrCode->getBackgroundColor())->toBe([255, 255, 0]);
});

it('sets the error correction level h', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::H());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::H());
});

it('sets the error correction level l', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::L());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::L());
});

it('sets the error correction level q', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::Q());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::Q());
});

it('throws an execption if the error correction level is not existing', function () {
    $qrCode = new UrlQrCode;

    expect(fn () => $qrCode->setErrorCorrectionLevel('F'))
        ->toThrow(InvalidArgumentException::class);
});

it('sets the error correction level m', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::M());

    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::M());
});

it('sets the url data correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setUrl('https://www.example.com');

    expect($qrCode->getData())->toBe('https://www.example.com');
});

it('sets the margin correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setMargin(100);

    expect($qrCode->getMargin())->toBe(100);
});

it('sets the top right eye color correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setTopRightEyeColor([255, 255, 255]);

    expect($qrCode->getTopRightEyeColor())->toBe([255, 255, 255]);
});

it('sets the top left eye color correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setTopLeftEyeColor([255, 255, 255]);

    expect($qrCode->getTopLeftEyeColor())->toBe([255, 255, 255]);
});

it('sets the bottom left eye color correctly', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setBottomLeftEyeColor([255, 255, 255]);

    expect($qrCode->getBottomLeftEyeColor())->toBe([255, 255, 255]);
});

it('generates correct qr code', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setUrl('https://example.com');

    $result = $qrCode->generate();

    expect($result)->toBeString();
});

it('constructs with correct defaults', function () {
    $qrCode = new UrlQrCode;

    expect($qrCode->getSize())->toBe(300);
    expect($qrCode->getColor())->toBe([0, 0, 0]);
    expect($qrCode->getBackgroundColor())->toBe([255, 255, 255]);
    expect($qrCode->getMargin())->toBe(10);
    expect($qrCode->getErrorCorrectionLevel())->toBe(ErrorCorrectionLevel::M());
    expect($qrCode->getTopLeftEyeColor())->toBe([0, 0, 0]);
    expect($qrCode->getTopRightEyeColor())->toBe([0, 0, 0]);
    expect($qrCode->getBottomLeftEyeColor())->toBe([0, 0, 0]);
    expect($qrCode->getFormat())->toBe('png');
});

it('sets the format png', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setFormat('png');

    expect($qrCode->getFormat())->toBe('png');
});

it('sets the format svg', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setFormat('svg');

    expect($qrCode->getFormat())->toBe('svg');
});

it('sets the format eps', function () {
    $qrCode = new UrlQrCode;
    $qrCode->setFormat('eps');

    expect($qrCode->getFormat())->toBe('eps');
});

it('throws an error for not supported format', function () {
    $qrCode = new UrlQrCode;

    expect(fn () => $qrCode->setFormat('xyz'))
        ->toThrow(InvalidArgumentException::class);
});

it('returns a valid base64-encoded PNG string', function () {
    // Step 1: Create a QR code instance and generate the base64 string
    $qrCode = (new UrlQrCode())
        ->setUrl('https://example.com')
        ->setSize(300)
        ->setFormat('png');  // Ensure it's set to PNG

    $base64QrCode = $qrCode->toBase64();

    // Step 2: Assert that the base64 string starts with the correct data URI prefix
    expect($base64QrCode)->toStartWith('data:image/png;base64,');

    // Step 3: Verify that the remainder of the string is a valid Base64-encoded value
    $base64String = str_replace('data:image/png;base64,', '', $base64QrCode);
    expect(base64_decode($base64String, true))->not()->toBeFalse(); // Ensure it's valid Base64
});

it('returns a valid base64-encoded SVG string', function () {
    // Step 1: Create a QR code instance and generate the base64 string for SVG
    $qrCode = (new UrlQrCode())
        ->setUrl('https://example.com')
        ->setSize(300)
        ->setFormat('svg');  // Set format to SVG

    $base64QrCode = $qrCode->toBase64();

    // Step 2: Assert that the base64 string starts with the correct data URI prefix
    expect($base64QrCode)->toStartWith('data:image/svg+xml;base64,');

    // Step 3: Verify that the remainder of the string is a valid Base64-encoded value
    $base64String = str_replace('data:image/svg+xml;base64,', '', $base64QrCode);
    expect(base64_decode($base64String, true))->not()->toBeFalse(); // Ensure it's valid Base64
});

it('returns a valid base64-encoded EPS string', function () {
    // Step 1: Create a QR code instance and generate the base64 string for SVG
    $qrCode = (new UrlQrCode())
        ->setUrl('https://example.com')
        ->setSize(300)
        ->setFormat('eps');  // Set format to SVG

    $base64QrCode = $qrCode->toBase64();

    // Step 2: Assert that the base64 string starts with the correct data URI prefix
    expect($base64QrCode)->toStartWith('data:application/postscript;base64,');

    // Step 3: Verify that the remainder of the string is a valid Base64-encoded value
    $base64String = str_replace('data:application/postscript;base64,', '', $base64QrCode);
    expect(base64_decode($base64String, true))->not()->toBeFalse(); // Ensure it's valid Base64
});

it('falls back to default format when an unsupported format is used', function () {
    // Step 1: Create a QR code instance and manually set an unsupported format
    $qrCode = new UrlQrCode();
    $qrCode->setUrl('https://example.com');

    // Manually set an unsupported format
    $reflection = new ReflectionClass($qrCode);
    $formatProperty = $reflection->getProperty('format');
    $formatProperty->setValue($qrCode, 'unsupported');

    // Step 2: Generate the base64-encoded string
    $base64QrCode = $qrCode->toBase64();

    // Step 3: Assert that the fallback PNG MIME type is used
    expect($base64QrCode)->toStartWith('data:image/png;base64,');
});

