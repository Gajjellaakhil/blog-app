<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, Post $post) {
        $validated = $request->validate(['content' => 'required']);
        $comment = $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);
        return response()->json($comment->load('user'));
    }
    

// Implement other methods as needed

}
