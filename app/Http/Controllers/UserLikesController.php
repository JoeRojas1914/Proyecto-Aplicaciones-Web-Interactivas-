<?php

namespace App\Http\Controllers;

use App\Models\User_Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLikesController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();  // Obtener todos los posts

        // Verificar las reacciones del usuario en cada post
        $userReactions = User_Likes::where('user_id', Auth::id())->get();

        // Crear un array asociativo para facilitar la búsqueda de reacciones
        $reactions = [];
        foreach ($userReactions as $reaction) {
            $reactions[$reaction->post_id] = $reaction->reaction;
        }

        return view('posts.index', compact('posts', 'reactions'));
    }

    public function toggleLikeDislike(Request $request)
    {
        $user = Auth::user();
        $postId = $request->post_id;
        $reaction = $request->reaction;

        $existingReaction = User_Likes::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->first();

        if ($existingReaction) {
            $existingReaction->update(['reaction' => $reaction]);
        } else {
            User_Likes::create([
                'user_id' => $user->id,
                'post_id' => $postId,
                'reaction' => $reaction,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
