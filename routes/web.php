<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ArticleReviewController;

// Rotte per homepage
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/aboutUs', [PublicController::class, 'aboutUSFunction'])->name('aboutUs');

// Rotte Profili utenti
Route::get('/profilo/{user}', [UserController::class, 'show'])->name('profilo.show');

// Rotte Profili venditori
Route::get('/uservendor/index', [VendorController::class, 'index'])->name('uservendor.index');
Route::get('/uservendor/{id}', [VendorController::class, 'show'])->name('uservendor.profile');
Route::get('/become-vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
Route::get('/make-vendor/{user}', [VendorController::class, 'makeVendor'])->name('make.vendor');

// Rotte per recensioni 
Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

// Rotte per recensioni articoli 
Route::post('/article/{article}/review', [ArticleReviewController::class, 'store'])->name('article.reviews.store');


// Rotte per Articoli
Route::get('/create/article', [ArticleController::class, 'create'])->name('article.create');
Route::get('/show/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory');

// Rotte per revisori
Route::get('revisor/show', [RevisorController::class, 'show'])->middleware('isRevisor')->name('revisor.show');
Route::patch('/accept/{article}', [RevisorController::class, 'accept'])->name('accept');
Route::patch('/reject/{article}', [RevisorController::class, 'reject'])->name('reject');
Route::get('/revisor/reviews', [RevisorController::class, 'reviews'])->name('revisor.reviews');

// Recensioni articoli
Route::post('/revisor/article-reviews/{review}/approve', [RevisorController::class, 'approveArticleReview'])->name('revisor.articleReviews.approve');
Route::post('/revisor/article-reviews/{review}/reject', [RevisorController::class, 'rejectArticleReview'])->name('revisor.articleReviews.reject');


// Recensioni sito
Route::post('/revisor/site-reviews/{review}/approve', [RevisorController::class, 'approveSiteReview'])->name('revisor.siteReviews.approve');
Route::post('/revisor/site-reviews/{review}/reject', [RevisorController::class, 'rejectSiteReview'])->name('revisor.siteReviews.reject');

// Rotte per diventare Revisore
Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::get('/make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->middleware('auth')->name('make.revisor');

// Rotte per ricerca di articoli
Route::get('/search/article/', [PublicController::class, 'searchArticles'])->name('article.search');

// Rotta per cambiare lingua
Route::post('/lingua/{lang}', [PublicController::class, 'setLenguage'])->name('setLocale');

// Rotte per newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/revisor/newsletters', [NewsletterController::class, 'index'])->name('revisor.newsletters')->middleware(['auth', 'isRevisor']);


// Logiche per carrello 
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{article}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
