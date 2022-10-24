<?php

namespace Emad12\Fileupload;

use Illuminate\Support\ServiceProvider;

class FileuploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // register our controller
        $this->app->make('Emad12\Fileupload\FileuploadController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
    }
}
