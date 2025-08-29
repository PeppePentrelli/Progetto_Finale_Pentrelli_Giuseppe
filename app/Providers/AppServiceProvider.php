<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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

        View::share('articles', Article::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get());

        if (Schema::hasTable('categories')) { 
            View::share('categories', Category::orderBy('name')->get());
        }

        // Logica per usare paginazione con bootstrap

    Paginator::useBootstrapFive();
    Paginator::useBootstrapFour();


            // conteggio carrello
        View::composer('*', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            }

            $view->with('cartCount', $cartCount);
        });

            view()->composer('*', function ($view) {
        $pendingReviewsCount = Review::where('approved', false)->count();
        $view->with('pendingReviewsCount', $pendingReviewsCount);
    });

        $ClientOrders = Order::where('status', 'in attesa')->count();
    View::share('ClientOrders', $ClientOrders);
    }
}