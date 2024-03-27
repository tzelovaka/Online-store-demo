<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UpdateRequest;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        return Inertia::render('News/Index', [
            'posts' => Post::all(),
        ]);
    }
    public function show(Post $post)
    {
        $user = Auth::user();
        $role = $user->role; 
        return Inertia::render('News/Show', [
            'post' => Post::find($post)[0],
            'adminAccess' => $role === 'admin'
        ]);
    }
    public function edit(Post $post)
    {
        $this->authorize('view', auth()->user());
        return inertia('News/Edit', compact('post'));
    }
    public function update(Post $post, UpdateRequest $request)
    {
        $this->authorize('view', auth()->user());
        $post->update($request->validated());
        return Inertia::render('News/Show', [
            'post' => Post::find($post)[0],
        ]);
    }
    public function delete(Post $post)
    {
        $this->authorize('view', auth()->user());
        $post->delete();
        return Inertia::render('News/Index', [
            'posts' => Post::all(),
        ]);
    }
}
