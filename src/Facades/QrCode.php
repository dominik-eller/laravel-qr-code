<?php

namespace Deller\QrCode\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Deller\QrCode\QrCode
 */
class QrCode extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'qr-code';  // This should match the binding name in the service provider
    }
}
