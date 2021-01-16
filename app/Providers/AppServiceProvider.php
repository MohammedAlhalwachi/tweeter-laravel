<?php

namespace App\Providers;

use App\FlysystemAdapters\CloudinaryAdapterExtension;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

use League\Flysystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        Storage::extend('cloudinary', function ($app, $config) {
            $container = new CloudinaryAdapterExtension([
                'cloud_name' => $config['cloud_name'],
                'api_key' => $config['api_key'],
                'api_secret' => $config['api_secret'],
                'overwrite' => true, // set this to true if you want to overwrite existing files using $filesystem->write();
            ]);

            return new Filesystem($container);
        });
    }
}
