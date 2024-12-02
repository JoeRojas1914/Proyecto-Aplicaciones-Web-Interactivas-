<?php
// This controller manages the logic for "Peliculas" views

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieApiService;
use App\Models\Post;

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

    public function show($id_movie)
    {
        $movie = MovieApiService::getMovieData($id_movie);
        $posts = Post::where('movie_id', $id_movie)->orderBy('created_at', 'desc')->get();
        // dd($movie);
        return view('movies.show', compact('movie', 'posts'));
    }
}
