<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Kontak;

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
        try {
            if (Schema::hasTable('settings')) {
                View::share('site_settings', Setting::pluck('value', 'key')->toArray());
            }
            if (Schema::hasTable('kontaks')) {
                View::share('footer_kontak', Kontak::where('is_active', true)->first());
            }
        } catch (\Exception $e) {
            // Do nothing if table doesn't exist yet
        }
    }
}
