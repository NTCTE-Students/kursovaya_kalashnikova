<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Post;
use Illuminate\Http\Request;

class indexController extends Controller
{
   public function index(Request $request)
{
    $themes = Theme::withCount('posts')->get();
    
    $posts = Post::with(['user', 'themes'])
        ->withCount('likes')
        ->when($request->search, function($query) use ($request) {
            return $query->where('title', 'like', "%{$request->search}%")
                        ->orWhere('content', 'like', "%{$request->search}%");
        })
        ->when($request->theme_id, function($query) use ($request) {
            return $query->whereHas('themes', function($q) use ($request) {
                $q->where('id', $request->theme_id);
            });
        })
        ->latest()
        ->get();

    return view('index', compact('posts', 'themes'));
}
}