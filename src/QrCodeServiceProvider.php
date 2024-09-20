<?php

namespace Deller\QrCode;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Deller\QrCode\Commands\QrCodeCommand;

class QrCodeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-qr-code')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_qr_code_table')
            ->hasCommand(QrCodeCommand::class);
    }
}
