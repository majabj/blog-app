<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, int $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        $userId = Auth::check() ? Auth::id() : null;
        Comment::create([
            'post_id' => $id,
            'user_id' => $userId,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $userId = Auth::id();
        if ($userId === $comment->user_id || $userId === $comment->post->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted!');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }
}
