<?php

namespace App\Http\Controllers;
use App\Models\Theme;
Use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $themes = Theme::all();
        $themeId = $request->input('theme_id');
        $search = $request->input('search');
        $posts = Post::query()
            ->with('user')
            ->when($themeId, function ($query) use ($themeId) {
                return $query->whereHas('themes', function ($q) use ($themeId) {
                    $q->where('themes.id', $themeId);
                });
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%")
                            ->orWhere('content', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10); 

        return view('posts.index', [
            'posts' => $posts,
            'themes' => $themes
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'themes' => 'required|array',
        ]);
        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => auth()->id()
        ]);
        $post->themes()->sync($validatedData['themes']);
        return redirect()->route('posts.index');
    }

    public function show(string $id)
    {
        $post = Post::with(['user', 'themes'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }
        public function edit(string $id)
    {

        $themes = Theme::all();
        $post = Post::find($id);
        if ($post->user_id == auth()->id()) {
            return view('posts.edit', compact('post', 'themes'));
        }
        return redirect()->route('posts.show', $post->id);
    }


    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'themes' => 'required|array',
        ]);

        $post = Post::findOrFail($id);


        if ($post->user_id !== auth()->id()) {
            return back()->with('error', 'Вы не можете редактировать этот пост');
        }

        $post->update($validatedData);
        $post->themes()->sync($request->input('themes', [])); 

        return redirect()->route('posts.show', $post->id);
    }
    
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);


        if ($post->user_id !== auth()->id()) {
            return back()->with('error', 'Вы не можете удалить этот пост');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Пост успешно удален');
    }
        public function create()
    {
        $themes = Theme::all();
        return view('posts.create', compact('themes'));
    }
}   

