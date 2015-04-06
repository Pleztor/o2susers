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
        \App::bind('Users', function() {
            return new \O2s\Users;
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

        // Configuration
        $this->publishes([
            __DIR__.'/config.php' => config_path('o2s_users.php'),
        ]);
    }

}