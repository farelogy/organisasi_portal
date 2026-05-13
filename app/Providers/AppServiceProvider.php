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
                $siteSettings = Setting::pluck('value', 'key')->toArray();
                if (!empty($siteSettings['site_logo'])) {
                    $siteSettings['site_logo'] = asset($siteSettings['site_logo']);
                }
                if (!empty($siteSettings['site_logo_secondary'])) {
                    $siteSettings['site_logo_secondary'] = asset($siteSettings['site_logo_secondary']);
                }
                if (!empty($siteSettings['site_favicon'])) {
                    $siteSettings['site_favicon'] = asset($siteSettings['site_favicon']);
                }
                View::share('site_settings', $siteSettings);
            }
            if (Schema::hasTable('kontaks')) {
                View::share('footer_kontak', Kontak::where('is_active', true)->first());
            }
        } catch (\Exception $e) {
            // Do nothing if table doesn't exist yet
        }
    }
}
