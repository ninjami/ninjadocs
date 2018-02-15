<?php

namespace Ninjami\Ninjadocs;

use Illuminate\Support\ServiceProvider;

class NinjadocsServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->loadRoutesFrom(__DIR__.'/routes.php');
      $this->loadViewsFrom(__DIR__ . '/views', 'ninjadocs');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ninjadocs', function($app) {
            return new Ninjadocs();
        });
    }

    public function provides() {
        return ['ninjadocs'];
    }
}
