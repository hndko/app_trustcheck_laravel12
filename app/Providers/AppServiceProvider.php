<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
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
        // Rate Limiter untuk proteksi endpoint pencarian (Maksimal 5 pencarian per menit per IP)
        RateLimiter::for('search', function (Request $request) {
            return app()->runningUnitTests()
                ? Limit::none()
                : Limit::perMinute(5)->by($request->ip())->response(function (Request $request, array $headers) {
                    return back()->with('error', 'Terlalu banyak permintaan pencarian. Mohon tunggu maksimal 1 menit sebelum melakukan pencarian kembali.');
                });
        });

        // Secara otomatis memberikan seluruh izin kepada pengguna dengan role superadmin
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });
    }
}
