# Generate QR Codes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dominik-eller/laravel-qr-code.svg?style=flat-square)](https://packagist.org/packages/dominik-eller/laravel-qr-code)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/dominik-eller/laravel-qr-code/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/dominik-eller/laravel-qr-code/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/dominik-eller/laravel-qr-code/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/dominik-eller/laravel-qr-code/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dominik-eller/laravel-qr-code.svg?style=flat-square)](https://packagist.org/packages/dominik-eller/laravel-qr-code)

This package allows you to generate QR Codes.

## Installation

You can install the package via composer:

```bash
composer require dominik-eller/laravel-qr-code
```

## Usage

All QR codes are created via the `QrCode` facade. Call `generate()` to get a binary string, or `toBase64()` to get a data URI ready for use in an `<img>` tag.

### URL

```php
use Deller\QrCode\Facades\QrCode;

$qrCode = QrCode::create(‘url’)
    ->setUrl(‘https://example.com’)
    ->setSize(300)
    ->setColor([0, 0, 0])
    ->setBackgroundColor([255, 255, 255])
    ->setErrorCorrectionLevel(‘H’)
    ->generate();
```

### Text

```php
$qrCode = QrCode::create(‘text’)
    ->setText(‘Hello, World!’)
    ->setSize(300)
    ->generate();
```

### E-Mail

```php
$qrCode = QrCode::create(‘email’)
    ->setEmail(‘contact@example.com’)
    ->setSize(300)
    ->generate();
```

Opening the QR code encodes a `mailto:contact@example.com` link.

### Phone number

```php
$qrCode = QrCode::create(‘phone’)
    ->setPhoneNumber(‘+43123456789’)
    ->setSize(300)
    ->generate();
```

Opening the QR code encodes a `tel:+43123456789` link.

### Wi-Fi

`WifiQrCode` is not registered by default and must be added first:

```php
use Deller\QrCode\Facades\QrCode;
use Deller\QrCode\Types\WifiQrCode;

QrCode::registerType(‘wifi’, WifiQrCode::class);

$qrCode = QrCode::create(‘wifi’)
    ->setSsid(‘MyNetwork’)
    ->setPassword(‘secret’)
    ->setEncryption(‘WPA’)   // WPA, WEP, or nopass
    ->setSize(300)
    ->generate();
```

### Output formats

The default output format is PNG. Use `setFormat()` to switch to SVG or EPS:

```php
$svg = QrCode::create(‘url’)
    ->setUrl(‘https://example.com’)
    ->setFormat(‘svg’)
    ->generate();
```

### Base64 data URI

Use `toBase64()` to embed the QR code directly in HTML:

```php
$dataUri = QrCode::create(‘url’)
    ->setUrl(‘https://example.com’)
    ->toBase64();

// <img src="{{ $dataUri }}">
```

### Custom eye colors

The three finder-pattern squares ("eyes") can be colored independently:

```php
$qrCode = QrCode::create(‘url’)
    ->setUrl(‘https://example.com’)
    ->setTopLeftEyeColor([255, 0, 0])
    ->setTopRightEyeColor([0, 0, 255])
    ->setBottomLeftEyeColor([0, 128, 0])
    ->generate();
```

### Custom types

Register your own QR code type by extending `QrCode` and implementing `getData()`:

```php
use Deller\QrCode\QrCode as BaseQrCode;

class VCardQrCode extends BaseQrCode
{
    public function getData(): string
    {
        return "BEGIN:VCARD\nVERSION:3.0\nFN:Jane Doe\nEND:VCARD";
    }
}

QrCode::registerType(‘vcard’, VCardQrCode::class);

$qrCode = QrCode::create(‘vcard’)->generate();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please report security vulnerabilities by email to me@dominik-eller.de instead of using the issue tracker.

## Credits

- [Dominik Eller](https://github.com/dominik-eller)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
