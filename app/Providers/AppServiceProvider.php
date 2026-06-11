<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Nowe role dostępowe (Moderator ma dostęp do wszystkiego)
        Gate::define('is_staff', fn(User $user) => in_array($user->role, ['moderator', 'admin_cars', 'admin_reviews', 'admin_repairs']));

        Gate::define('admin_cars', fn(User $user) => in_array($user->role, ['moderator', 'admin_cars']));
        Gate::define('admin_reviews', fn(User $user) => in_array($user->role, ['moderator', 'admin_reviews']));
        Gate::define('admin_repairs', fn(User $user) => in_array($user->role, ['moderator', 'admin_repairs']));
    }
}
