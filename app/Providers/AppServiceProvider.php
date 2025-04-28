<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\SocialLink;
use Illuminate\Support\Facades\View;
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
        View::composer('web.include.footer', function ($view) {
            $social_link = SocialLink::where('status', 1)->first();
            $view->with('social_link', $social_link);
        });

        View::composer('admin.include.sidenav', function ($view) {
            $social_link = SocialLink::where('status', 1)->first();
            $address = Address::where('status', 1)->count();
            $view->with('social_link', $social_link)
            ->with('address',$address);
        });
    }
    
}
