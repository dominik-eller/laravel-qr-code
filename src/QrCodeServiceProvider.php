<?php

namespace Deller\QrCode;

use Deller\QrCode\Factories\QrCodeFactory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Class QrCodeServiceProvider
 *
 * This class is responsible for registering and configuring the QR Code package.
 * It extends the `PackageServiceProvider` provided by Spatie's Laravel Package Tools,
 * which simplifies the process of setting up custom Laravel packages.
 *
 * More information: https://github.com/spatie/laravel-package-tools
 */
class QrCodeServiceProvider extends PackageServiceProvider
{
    /**
     * Configure the package.
     *
     * This method is responsible for defining the package name and registering its components.
     * The package is identified by the name `laravel-qr-code`.
     *
     * @param  Package  $package  The package instance for configuration.
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-qr-code');
    }

    /**
     * Register the package services.
     *
     * This method binds the `qr-code` service to the service container, ensuring that the
     * `QrCodeFactory` class is resolved whenever the `qr-code` service is requested.
     * The `singleton` ensures that only one instance of `QrCodeFactory` is created during the application's lifetime.
     *
     * @return void
     */
    public function packageRegistered()
    {
        $this->app->singleton('qr-code', function ($app) {
            return new QrCodeFactory;
        });
    }
}
