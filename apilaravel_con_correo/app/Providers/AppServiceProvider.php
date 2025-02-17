<?php

namespace App\Providers;

use App\Http\Domain\Models\IUserRepository;
use App\Http\Domain\Models\IUserService;
use App\Http\Infrastructure\UserRepository;

use App\Http\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //cuando requiera esta interfaz, llamame a esta otra 
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
