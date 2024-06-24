<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {  


        /* AuthorizationIf your application environment is local the /auth/setup route can be accessed. Alternatively 
        if you are on production and you want to access the Auth Setup, you can add the following Authorization Gate, 
        to the boot() method inside your AppServiceProvider */

        Gate::define('viewAuthSetup', function (\DevDojo\Auth\Models\User $user) {
            return in_array($user->email, [
                '[email protected]',
            ]);
        });
        //
    }
}
