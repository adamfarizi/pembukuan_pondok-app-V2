<?php

namespace App\Providers;

use App\Models\Pendaftaran;
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
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');

        // Share totalPendaftaranBaru with all views
        $totalPendaftaranBaru = Pendaftaran::where('status','belum_verifikasi')->count();
        View::share('totalPendaftaranBaru', $totalPendaftaranBaru);
    }
}
