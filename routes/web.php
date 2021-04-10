<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// page d'accueil, affichage des animes
Route::get('/', [AnimeController::class, 'getAllAnime']);

// page de login
Route::get('/login', function () {
  return view('login');
});

// page de creation de compte
Route::get('/signup', function () {
  return view('signup');
});

// Authentification
Route::post('/login', [AuthController::class, 'logIn']);
Route::post('signup', [AuthController::class, 'signUp']);
Route::post('signout', [AuthController::class, 'logOut']);


// page d'un anime
Route::get('/anime/{id}', [AnimeController::class, 'showAnime'])->name('getAnime');
// page de review d'un anime
Route::get('/anime/{id}/new_review', [AnimeController::class, 'getAnime']);
// amene sur le formulaire d'ajout de review
Route::post('/add_review', [ReviewController::class, 'addReview']);
// amene sur la page d'erreur review
Route::get('/add_review_error/{id}', [ReviewController::class, 'goToAddReviewError']);
// amene sur le formulaire de modification de review
Route::post('/anime/{id}/edit_review', [ReviewController::class, 'goToeditReviewForm']);
// modifie une review
Route::post('/edit_review', [ReviewController::class, 'editReview']);

// amene sur la page top
Route::get('/top', [TopController::class, 'goToTop']);

// amene sur la page de watchlist
Route::get('/watchlist', [WatchlistController::class, 'goToWatchlist']);
// ajoute a la watchlist
Route::post('/anime/{id}/add_to_watch_list', [WatchlistController::class, 'addToWatchlist']);
// retire de la watchlist
Route::post('/anime/{id}/remove_from_watch_list', [WatchlistController::class, 'removeFromWatchlist']);