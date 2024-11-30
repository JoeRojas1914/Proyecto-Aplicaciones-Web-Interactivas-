<?php
// This controller manages the logic for "Peliculas" views

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     * Returns top rated movies and movies by genre
     */
    public function index()
    {
        // $topRatedMovies = $this->getTopRatedMovies();
        // TODO add view
        // return view('movies.index');
    }	
}
