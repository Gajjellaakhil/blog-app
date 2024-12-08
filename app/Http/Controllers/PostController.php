<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // List all posts
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    // Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show form to create a new post (Admin Only)
    public function create()
    {
        return view('admin.posts.create');
    }

    // Store a new post (Admin Only)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    // Show form to edit an existing post (Admin Only)
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Update an existing post (Admin Only)
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $imagePath = $post->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath && \Storage::exists("public/$imagePath")) {
                \Storage::delete("public/$imagePath");
            }
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete a post (Admin Only)
    public function destroy(Post $post)
    {
        if ($post->image_path && \Storage::exists("public/{$post->image_path}")) {
            \Storage::delete("public/{$post->image_path}");
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}
