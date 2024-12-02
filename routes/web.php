<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/solicitud', [SolicitudController::class, 'store'])->name('solicitud.store');


    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    // Route::get('/movie/{id}', [PostController::class, 'getMovieDataFromApi'])->name('posts.data');

    Route::get('/movies', [MoviesController::class, 'index'])->name('movies.index');
    Route::get('/movies/{id_movie}', [MoviesController::class, 'show'])->name('movies.show');
    // Route::post('/movies/{id_movie}', [MoviesController::class, 'addToWatchList'])->name('movies.addToWatchList');
    // watchlist.toggle
    Route::post('/watchlist/{id_movie}', [MoviesController::class, 'toggleWatchList'])->name('watchlist.toggle');

    Route::get('/admin/solicitudes', [SolicitudController::class, 'index'])->name('admin.index');
    Route::patch('/admin/solicitudes/{solicitud}', [SolicitudController::class, 'update'])->name('admin.update');
});

require __DIR__.'/auth.php';


route::get('admin/dashboard', [HomeController::class, 'index'])->
    middleware(['auth', 'admin']);