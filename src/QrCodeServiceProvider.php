<?php

namespace Deller\QrCode;

use Deller\QrCode\Factories\QrCodeFactory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasViews();
    }

    public function packageRegistered()
    {
        $this->app->singleton('qr-code', function ($app) {
            return new QrCodeFactory;
        });
    }
}
