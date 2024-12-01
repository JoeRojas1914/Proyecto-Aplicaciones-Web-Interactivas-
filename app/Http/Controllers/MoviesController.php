<?php
// This controller manages the logic for "Peliculas" views

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieApiService;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     * Returns top rated movies, movies currently on theatres and upcoming movies.
     */
    public function index()
    {
        $topRatedMovies = MovieApiService::getTopRatedMovies();
        $upcomingMovies = MovieApiService::getUpcomingMovies();
        $nowPlayingMovies = MovieApiService::getNowPlayingMovies();
        // dd($topRatedMovies);
        return view('movies.index', compact('topRatedMovies', 'upcomingMovies', 'nowPlayingMovies'));
    }	
}
