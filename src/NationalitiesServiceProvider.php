<?php

namespace Aneef\Nationalities;

use Illuminate\Support\ServiceProvider;

class NationalitiesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the Nationalities class as a singleton
        $this->app->singleton(Nationalities::class, function ($app) {
            return new Nationalities();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish language files
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/nationalities'),
        ], 'lang');

        // Publish config file
        $this->publishes([
            __DIR__ . '/../config/nationalities.php' => config_path('nationalities.php'),
        ], 'config');

        // Load package translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'nationalities');

        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/nationalities.php', 'nationalities');

        // Register facade alias
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Nationalities', \Aneef\Nationalities\Facades\Nationalities::class);
    }
}
