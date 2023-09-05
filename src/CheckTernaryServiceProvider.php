<?php

namespace Checkternary\CheckTernary;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Checkternary\CheckTernary\Commands\CheckTernaryCommand;

/**
 * Summary of CheckTernaryServiceProvider
 */
class CheckTernaryServiceProvider extends PackageServiceProvider
{
    /**
     * Summary of configurePackage
     * @param \Spatie\LaravelPackageTools\Package $package
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('checkternary')
            ->hasConfigFile('checkternary')
            ->hasCommand(CheckTernaryCommand::class);
    }
}