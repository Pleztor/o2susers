<?php namespace O2s\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Users', function() {
            return new \O2s\Users\Users;
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Set up routing
        include __DIR__.'/routes.php';

        // Views
        $this->loadViewsFrom(__DIR__.'/views', 'o2susers');

        // Published items
        $this->publishes([
            // configuration file
            __DIR__.'/config.php' => config_path('o2susers.php'),

            // Database Seed File(s)
            __DIR__.'/db/seeds/' => base_path('database/seeds'),
        ]);
    }
}