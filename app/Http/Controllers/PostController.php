<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(int $id)
    {
        $post = Post::with(['user', 'comments.user'])->find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }

        return view('posts.show', compact('post'));
    }

    public function edit(int $id)
    {
        $post = Post::findOrFail($id);
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, int $id)
    {
        $post = Post::findOrFail($id);
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $post->update($validated);
        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
