<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreRequest;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function store(StoreRequest $request){
        //dd($request->validated());
        $this->authorize('view', auth()->user());
        Post::create($request->validated());
        return redirect()->route('news');
    }
    public function index() {
        $user = Auth::user();
        $role = $user->role; 
        return Inertia::render('Dashboard', [
            'adminAccess' => $role === 'admin'
        ]);
    }
}
