<?php

namespace Deller\QrCode\Factories;

use Deller\QrCode\QrCode;
use Deller\QrCode\Types\EmailQrCode;
use Deller\QrCode\Types\PhoneNumberQrCode;
use Deller\QrCode\Types\TextQrCode;
use Deller\QrCode\Types\UrlQrCode;
use InvalidArgumentException;

/**
 * Class QrCodeFactory
 *
 * This factory class is responsible for creating different types of QR code generators.
 * It supports predefined QR code types such as URL, Text, Email, and Phone, and allows
 * registering custom QR code types dynamically.
 */
class QrCodeFactory
{
    /**
     * The available QR code types and their corresponding class names.
     *
     * @var array<string, string> An associative array mapping QR code types to their class names.
     */
    protected static array $types = [
        'url' => UrlQrCode::class,
        'text' => TextQrCode::class,
        'email' => EmailQrCode::class,
        'phone' => PhoneNumberQrCode::class,
    ];

    /**
     * Create a QR code generator based on the specified type.
     *
     * This method returns an instance of the appropriate QR code generator class
     * (e.g., `UrlQrCode`, `TextQrCode`, `EmailQrCode`, `PhoneNumberQrCode`), depending
     * on the type provided. If the type is not supported, an `InvalidArgumentException` is thrown.
     *
     * @param string $type The type of QR code to generate (e.g., 'url', 'text', 'email', 'phone').
     * @return QrCode An instance of the corresponding QR code class.
     * @throws InvalidArgumentException If the provided type is not supported.
     */
    public static function create(string $type): QrCode
    {
        if (! array_key_exists($type, self::$types)) {
            throw new InvalidArgumentException("QR code type [$type] is not supported.");
        }

        $className = self::$types[$type];

        return new $className;
    }

    /**
     * Register a custom QR code type.
     *
     * This method allows users to register a custom QR code type by providing the type name
     * and the class name that implements the functionality for that type.
     *
     * @param string $type The custom QR code type to register.
     * @param string $class The class name that handles QR code generation for the custom type.
     * @return void
     */
    public static function registerType(string $type, string $class)
    {
        self::$types[$type] = $class;
    }
}
