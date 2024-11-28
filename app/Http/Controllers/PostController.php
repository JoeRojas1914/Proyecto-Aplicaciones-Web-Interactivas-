<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
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
}
