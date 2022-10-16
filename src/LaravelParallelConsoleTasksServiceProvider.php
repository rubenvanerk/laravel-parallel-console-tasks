<?php

namespace RubenVanErk\LaravelParallelConsoleTasks;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelParallelConsoleTasksServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-parallel-console-tasks');
    }
}
