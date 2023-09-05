<?php

namespace Checkternary\CheckTernary;

use Checkternary\CheckTernary\Commands\CheckTernaryCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Summary of CheckTernaryServiceProvider
 */
class CheckTernaryServiceProvider extends PackageServiceProvider
{
    /**
     * Summary of configurePackage
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
