<?php

namespace Deller\QrCode\Commands;

use Illuminate\Console\Command;

class QrCodeCommand extends Command
{
    public $signature = 'laravel-qr-code';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
