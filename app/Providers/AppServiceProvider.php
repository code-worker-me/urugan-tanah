<?php

namespace App\Providers;

use App\Models\Urugan;
use App\Policies\UruganPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(Urugan::class, UruganPolicy::class);
        Gate::define("kantor", fn($user) => $user->role === "kantor");
        Gate::define("konstruktor", fn($user) => $user->role === "konstruktor");
        Gate::define("lapangan", fn($user) => $user->role === "lapangan");
        Gate::define("view-dashboard", function ($user) {
            return in_array($user->role, ["kantor", "konstruktor"]);
        });
    }
}
