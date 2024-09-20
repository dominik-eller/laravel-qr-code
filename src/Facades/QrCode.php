<?php

namespace Deller\QrCode\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class QrCode
 *
 * This facade provides a static interface to the underlying `QrCode` service.
 * It allows developers to easily generate different types of QR codes (URL, text, email, phone number, etc.)
 * through Laravel's facade system without needing to manually resolve the `QrCodeFactory` from the service container.
 *
 * Example usage:
 * ```
 * QrCode::create('url')->setUrl('https://example.com')->generate();
 * ```
 *
 * @method static \Deller\QrCode\QrCode create(string $type) Create a new QR code generator instance of the specified type.
 * @method static void registerType(string $type, string $class) Register a custom QR code type with a class.
 *
 * @see \Deller\QrCode\QrCode
 */
class QrCode extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * This method returns the key used to retrieve the underlying service
     * (in this case, the `QrCodeFactory`) from the service container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'qr-code';  // This should match the binding name in the service provider
    }
}
