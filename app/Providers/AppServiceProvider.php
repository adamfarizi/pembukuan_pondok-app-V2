<?php

namespace App\Providers;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // set locale
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        // if *not* running in Artisan (so migrations won’t trigger this)
        if (! $this->app->runningInConsole()) {
            $totalPendaftaranBaru = Pendaftaran::where('status', 'belum_verifikasi')->count();
            View::share('totalPendaftaranBaru', $totalPendaftaranBaru);
        }
    }
}
