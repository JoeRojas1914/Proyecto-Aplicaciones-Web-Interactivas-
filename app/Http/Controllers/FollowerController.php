<?php

namespace App\Http\Controllers;

use App\Models\User_Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function toggleFollow(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = Auth::user(); 
        $followedUserId = $request->input('user_id'); 

        $existingFollow = User_Likes::where('follower_id', $user->id)
            ->where('followed_id', $followedUserId)
            ->first();

        if ($existingFollow) {
            $existingFollow->delete();
            return response()->json(['success' => true, 'message' => 'Dejaste de seguir al usuario']);
        } else {
            User_Likes::create([
                'follower_id' => $user->id,
                'followed_id' => $followedUserId,
            ]);
            return response()->json(['success' => true, 'message' => 'Ahora sigues a este usuario']);
        }
    }
}
