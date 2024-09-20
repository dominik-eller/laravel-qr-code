<?php

namespace Deller\QrCode\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Deller\QrCode\QrCode
 */
class QrCode extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Deller\QrCode\QrCode::class;
    }
}
