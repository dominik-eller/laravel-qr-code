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

### Usage Example: Generating a URL QR Code

You can easily generate a QR code for a URL by using the `QrCode` facade. Here’s how you can generate a QR code for a URL like `https://example.com`:

```php
use Deller\QrCode\Facades\QrCode;

// Generate a QR code for a URL
$qrCode = QrCode::create('url')
    ->setUrl('https://example.com')
    ->setSize(300)  // Set the size of the QR code
    ->setColor([0, 0, 0])  // Set the foreground color (black)
    ->setBackgroundColor([255, 255, 255])  // Set the background color (white)
    ->setErrorCorrectionLevel('H')  // Set error correction level (High)
    ->generate();

// Now you can return the QR code as a string, or save it to a file, etc.
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
