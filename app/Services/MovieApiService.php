<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MovieApiService
{
    private static $apiKey;
    private static $apiToken;
    private static $apiEndpoint;

    /**
     * Initialize the MovieApiService with configuration values.
     *
     * This method sets the API key, token, and endpoint from the configuration file.
     *
     * @return void
     */
    public static function initialize()
    {
        self::$apiKey = config('services.movie_api.key');
        self::$apiToken = config('services.movie_api.token');
        self::$apiEndpoint = config('services.movie_api.endpoint');
    }

    /**
     * Retrieves movie data from an external API and caches the result.
     *
     * This method fetches movie data based on the provided movie ID. It first checks
     * if the data is available in the cache. If not, it makes an HTTP GET request to
     * the external API to retrieve the movie data. The result is then cached for future
     * requests.
     *
     * @param int $id_movie The ID of the movie to retrieve data for.
     * @return array The movie data retrieved from the API.
     * @throws \Exception If the movie data could not be retrieved.
     */
    public static function getMovieData($id_movie)
    {
        self::initialize();
        $cacheKey = 'movie_' . $id_movie;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $url = self::$apiEndpoint . 'movie/' . $id_movie;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . self::$apiToken,
            'accept' => 'application/json',
        ])->get($url,);

        if ($response->successful()) {
            $movie = $response->json();
            Cache::put($cacheKey, $movie, now()->addDay());
            return $movie;
        }

        throw new \Exception('No se pudo obtener el ID de la película.');
    }

    /**
     * Retrieves the top-rated movies from the API.
     *
     * This method initializes the service, checks if the top-rated movies are cached,
     * and if not, makes an HTTP request to the API to fetch the top-rated movies.
     * The result is then cached for a day.
     *
     * @return array The list of top-rated movies.
     * @throws \Exception If the API request fails.
     */
    public static function getTopRatedMovies()
    {
        self::initialize();
        $cacheKey = 'topRatedMovies';

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $url = self::$apiEndpoint . 'top_rated';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . self::$apiToken,
            'accept' => 'application/json',
        ])->get($url, [
            'page' => 1,
        ]);

        if ($response->successful()) {
            $movies = $response->json();
            Cache::put($cacheKey, $movies, now()->addDay());
            return $movies;
        }

        throw new \Exception('No se pudo obtener las películas mejor valoradas.');
    }
}