<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\CDO;
use App\Models\Developpeur;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
        Gate::define('admin', function() {
            return Admin::where('user_id', Auth::user()->id)->exists() ;
        });

        Gate::define('developpeur', function() {
            return Developpeur::where('user_id', Auth::user()->id)->exists();
        });
        Gate::define('cdo',function(){
            return CDO::where('user_id', Auth::user()->id)->exists();
        });
        Gate::define('devPremium', function(){
            return Developpeur::where('user_id', Auth::user()->id)->where('premium',1)->exists();
        });
        Gate::define('devBasic', function(){
            return Developpeur::where('user_id', Auth::user()->id)->where('premium',0)->where('developpeurs_isvalide',1)->exists();
        });
        Gate::define('CDOPremium', function(){
            return CDO::where('user_id', Auth::user()->id)->where('cdo_premium',1)->exists();
        });
        Gate::define('CDOBasic', function(){
            return CDO::where('user_id', Auth::user()->id)->where('cdo_premium',0)->where('cdo_isvalide',1)->exists();
        });
        Gate::define('devGuest', function(){
            return Developpeur::where('user_id', Auth::user()->id)->where('premium',0)->where('developpeurs_isvalide',0)->exists();
        });
        Gate::define('cdoguest', function(){
            return CDO::where('user_id', Auth::user()->id)->where('cdo_premium',0)->where('cdo_isvalide',0)->exists();
        }) ;
    }
}
