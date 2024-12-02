<?php

namespace App\Http\Controllers;

use App\Models\User_Likes_Dislikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'action' => 'required|in:like,dislike',
        ]);

        $userId = Auth::id();
        $postId = $request->post_id;
        $action = $request->action;

        $likeDislike = User_Likes_Dislikes::where('user_id', $userId)
            ->where('post_id', $postId)
            ->first();

        if ($likeDislike) {
            if (($action === 'like' && $likeDislike->likes) || ($action === 'dislike' && $likeDislike->dislikes)) {
                $likeDislike->delete();
                return response()->json(['status' => 'removed']);
            } else {
                $likeDislike->likes = $action === 'like' ? 1 : 0;
                $likeDislike->dislikes = $action === 'dislike' ? 1 : 0;
                $likeDislike->save();
                return response()->json(['status' => 'updated']);
            }
        } else {
            // Crear un nuevo registro si no existe
            User_Likes_Dislikes::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'likes' => $action === 'like' ? 1 : 0,
                'dislikes' => $action === 'dislike' ? 1 : 0,
            ]);
            return response()->json(['status' => 'created']);
        }
    }
}
