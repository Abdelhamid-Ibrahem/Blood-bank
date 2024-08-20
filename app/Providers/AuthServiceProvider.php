<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     */
    public function register(): void
    {
        parent::register();
        $this->app->bind('abilities', function () {
            return include base_path('data/abilities.php');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            if ($user->super_admin) {
                return true;
            }

        });

      foreach ($this->app->make('abilities') as $code => $lable) {
            Gate::define($code, function ($user) use($code){
                return $user->hasAbility($code);
            });
        }
    }

}

