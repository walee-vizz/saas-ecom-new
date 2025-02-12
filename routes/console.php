<?php

use App\Console\Commands\CreateModuleSymlinks;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('module:symlink', function () {
    // Create symlink for Modules folder
    $target = base_path('Modules');
    $link = public_path('Modules');
    if (!file_exists($link)) {
        if (symlink($target, $link)) {
            $this->info("Symlink created: $link -> $target");
        } else {
            $this->error("Failed to create symlink: $link");
        }
    } else {
        $this->info("Modules symlink already exists.");
    }

    // Create symlink for Themes folder (if desired)
    $targetTheme = base_path('themes');
    $linkTheme = public_path('themes');
    if (! file_exists($linkTheme)) {
        if (symlink($targetTheme, $linkTheme)) {
            $this->info("Symlink created: $linkTheme -> $targetTheme");
        } else {
            $this->error("Failed to create symlink: $linkTheme");
        }
    } else {
        $this->info("Themes symlink already exists.");
    }
})->describe('Automatically create symlinks for module and theme assets');
