<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(10);

        // Obtener los datos de la película para cada post
        foreach ($posts as $post) {
            try {
                $movieData = $this->getMovieDataFromApi($post->movie_id);
                $post->movie_title = $movieData['original_title'];
            } catch (\Exception $e) {
                // Manejar la excepción (por ejemplo, establecer un título predeterminado)
                $post->movie_title = 'Título no disponible';
            }
        }
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ignoramos likes y dislikes, ya que se inicializan a 0 por defecto        
        $validated_data = $request->validate([
            'movie_id' => 'required|integer|min:0',
            'content' => 'required|string',
            'rating' => 'integer|between:0,5',
        ]);

        // Agregar el ID del usuario autenticado a los datos validados
        $validated_data['user_id'] = Auth::id();
        $post = Post::create($validated_data);
        // * return redirect()->back()->with('success', 'Reseña creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        // * return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $validated_data = $request->validate([
            'movie_id' => 'required|integer|min:0',
            'content' => 'required|string',
            'rating' => 'integer|between:0,5',
        ]);

        $post->update($validated_data);
        // * return redirect()->back()->with('success', 'Reseña actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        // * return redirect()->back()->with('success', 'Reseña eliminada correctamente');
    }


    /**
     * Obtener los datos de la película desde la API externa.
     */
    private function getMovieDataFromApi($id_movie)
    {
        $cacheKey = 'movie_' . $id_movie;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // $apiKey = config('services.movie_api.key');
        $apiToken = config('services.movie_api.token');
        $apiEndpoint = config('services.movie_api.endpoint');
        $url = $apiEndpoint . 'movie/'.$id_movie;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
            'accept' => 'application/json',
        ])->get($url, [
            // 'api_key' => $apiKey,
            'language' => 'es',
        ]);

        if ($response->successful()) {
            $movie = $response->json();
            // Almacenar en caché los datos de la película durante 24 horas
            Cache::put($cacheKey, $movie, now()->addDay());
            return $movie;
        }

        throw new \Exception('No se pudo obtener el ID de la película.');
    }
}
