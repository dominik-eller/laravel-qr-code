# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
composer test                  # run the full test suite (Pest)
composer test-coverage         # run tests with coverage report
composer analyse               # run PHPStan static analysis (level 5)
composer format                # run Laravel Pint code formatter
composer build                 # prepare package and build workbench
composer start                 # build + serve workbench via testbench
```

Run a single test file:
```bash
vendor/bin/pest tests/Classes/UrlQrCodeTest.php
```

## Architecture

This is a Laravel package (`dominik-eller/laravel-qr-code`) built on top of `bacon/bacon-qr-code`. The namespace root is `Deller\QrCode`.

### Core flow

1. **`QrCodeFactory`** (`src/Factories/QrCodeFactory.php`) — resolves a type string (`'url'`, `'text'`, `'email'`, `'phone'`) to a concrete class and instantiates it. Custom types can be registered via `QrCodeFactory::registerType(string $type, string $class)`.
2. **`QrCode`** (`src/QrCode.php`) — abstract base class holding all rendering options (size, colors, margin, format, error correction level, eye colors). Subclasses must implement `getData(): string` which returns the raw string BaconQrCode encodes.
3. **Type classes** (`src/Types/`) — concrete subclasses (`UrlQrCode`, `TextQrCode`, `EmailQrCode`, `PhoneNumberQrCode`, `WifiQrCode`). Each adds type-specific setters and implements `getData()`. `WifiQrCode` is registered separately from the factory defaults — it is not in `$types` by default and must be added via `registerType`.
4. **`QrCodeServiceProvider`** — binds `QrCodeFactory` as a singleton under the key `'qr-code'`. Uses `spatie/laravel-package-tools`.
5. **`QrCode` Facade** (`src/Facades/QrCode.php`) — proxies to the `'qr-code'` singleton; entry point for most users.

### Rendering

`QrCode::generate()` selects a BaconQrCode backend based on `$this->format` (`png` → `ImagickImageBackEnd`, `svg` → `SvgImageBackEnd`, `eps` → `EpsImageBackEnd`), builds a `Fill` with per-eye colors, and returns a binary string. `toBase64()` wraps that in a data URI.

### Adding a new QR code type

1. Create `src/Types/FooQrCode.php` extending `QrCode`, implement `getData()`.
2. Register it in `QrCodeFactory::$types` or document that users must call `registerType`.
3. Add a corresponding test under `tests/Classes/`.

### Testing

Tests use Pest + Orchestra Testbench. `tests/TestCase.php` boots the package via `QrCodeServiceProvider`. PHPStan runs against `src/` at level 5 with a baseline at `phpstan-baseline.neon`.
