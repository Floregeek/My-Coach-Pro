<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

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
        // Partage le compte des messages non lus sur toutes les pages
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $count = Message::where('receiver_id', Auth::id())
                                ->whereNull('read_at')
                                ->count();
                $view->with('unreadMessagesCount', $count);
            } else {
                $view->with('unreadMessagesCount', 0);
            }
        });
    
    }
}
