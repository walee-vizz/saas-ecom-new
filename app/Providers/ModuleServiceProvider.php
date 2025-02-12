<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $modulesPath = base_path('Modules');

        // Loop through each module folder
        foreach (scandir($modulesPath) as $module) {
            if ($module === '.' || $module === '..') {
                continue;
            }

            // Define the expected route file for each module
            $routeFile = $modulesPath . '/' . $module . '/Routes/web.php';

            if (file_exists($routeFile)) {
                // Option 1: Load the route file as is:
                $this->loadRoutesFrom($routeFile);

                // Option 2: Load routes with a "web" middleware and optional controller namespace:
                // Route::middleware('web')
                //     ->namespace("Modules\\{$module}\\Http\\Controllers")
                //     ->group($routeFile);
            }
        }
    }
}
