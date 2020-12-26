<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\ProfileComposer;

class ViewServiceProvider extends ServiceProvider
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

     // Using closure based composers...
     View::composer('layouts.app', function ($view)  {
         if (Auth::check()) {
        // The user is logged in...
        $notifications =auth()->user()->notifications()->select('id','data','created_at','read_at')->get(); 
        $notificationCount = auth()->user()->unreadNotifications()->count();
        $view->with(['notifications'=> $notifications,'notificationCount'=>$notificationCount]);
     
        }
            
        });

    }
}