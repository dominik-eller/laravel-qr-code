<?php

namespace Deller\QrCode\Factories;

use Deller\QrCode\QrCode;
use Deller\QrCode\Types\EmailQrCode;
use Deller\QrCode\Types\PhoneNumberQrCode;
use Deller\QrCode\Types\TextQrCode;
use Deller\QrCode\Types\UrlQrCode;
use InvalidArgumentException;

class QrCodeFactory
{
    protected static $types = [
        'url' => UrlQrCode::class,
        'text' => TextQrCode::class,
        'email' => EmailQrCode::class,
        'phone' => PhoneNumberQrCode::class,
    ];

    /**
     * Create a QR code generator based on type.
     *
     * @param string $type
     * @return QrCode
     * @throws InvalidArgumentException
     */
    public static function create(string $type): QrCode
    {
        if (!array_key_exists($type, self::$types)) {
            throw new InvalidArgumentException("QR code type [$type] is not supported.");
        }

        $className = self::$types[$type];

        return new $className();
    }

    /**
     * Register a custom QR code type.
     *
     * @param string $type
     * @param string $class
     * @return void
     */
    public static function registerType(string $type, string $class)
    {
        self::$types[$type] = $class;
    }
}
