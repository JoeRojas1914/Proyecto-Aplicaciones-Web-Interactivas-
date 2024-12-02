<?php
// This controller manages the logic for "Peliculas" views

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieApiService;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

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
        $isInWatchList = false;
        if (auth()->check()) {
            $userId = auth()->id();
            $isInWatchList = DB::table('watch_list')
                ->where('user_id', $userId)
                ->where('movie_id', $id_movie)
                ->exists();
        }
        return view('movies.show', compact('movie', 'posts', 'isInWatchList'));
    }

    public function addToWatchList($id_movie)
    {
        $userId = auth()->id();
        DB::table('watch_list')->insert([
            'user_id' => $userId,
            'movie_id' => $id_movie,
        ]);
        return redirect()->back()->with('success', 'Pelicula añadida a ver más tarde');
    }

    public function toggleWatchList($id_movie){
        $userId = auth()->id();
        $isInWatchList = DB::table('watch_list')
            ->where('user_id', $userId)
            ->where('movie_id', $id_movie)
            ->exists();
        if ($isInWatchList) {
            DB::table('watch_list')
                ->where('user_id', $userId)
                ->where('movie_id', $id_movie)
                ->delete();
            return redirect()->back()->with('success', 'Pelicula eliminada correctamente de la lista de ver más tarde');
        } else {
            DB::table('watch_list')->insert([
                'user_id' => $userId,
                'movie_id' => $id_movie,
            ]);
            return redirect()->back()->with('success', 'Pelicula añadida a ver más tarde');
        }
    }
}
