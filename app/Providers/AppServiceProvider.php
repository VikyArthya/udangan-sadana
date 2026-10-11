<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $iniDir = base_path('.php-ini');
        if (is_dir($iniDir)) {
            $scanDir = ':'.$iniDir;
            putenv('PHP_INI_SCAN_DIR='.$scanDir);
            $_ENV['PHP_INI_SCAN_DIR'] = $scanDir;
            if (class_exists(ServeCommand::class)) {
                ServeCommand::$passthroughVariables[] = 'PHP_INI_SCAN_DIR';
            }
        }
    }
}
