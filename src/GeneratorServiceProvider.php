<?php

namespace Robin\Generator;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Defer.
     *
     * @var bool
     */
    protected $defer = true; 

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton('generator', function ($app) {
            return new Generator($app['session'], $app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'Generator'); 

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/generator'),  
            __DIR__.'/config/generator.php' => config_path('generator.php'), 
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['generator'];
    }
}
