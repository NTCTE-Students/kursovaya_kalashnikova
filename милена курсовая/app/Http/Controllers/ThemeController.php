<?php

namespace App\Http\Controllers;
Use App\Models\Theme;
Use App\Models\Post;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('themes.index', compact('themes'));
    }
    public function create()
    {
        return view('themes.create');
    }
    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Theme::create($request->all());
        return redirect()->route('themes.index');

    }
    public function show(string $id)
    {
        $theme = Theme::find($id);

             return view('themes.show', compact('theme'));
    }
    public function edit(string $id)
    {
        $theme = Theme::find($id);
        return view('themes.edit', compact('theme'));
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $theme = Theme::findOrFail($id);

        $theme->update($validatedData);

        return redirect()->route('themes.show', $theme->id);
    }
    public function destroy(string $id)
    {
        Theme::find($id) -> delete();
        return redirect()
            -> route('themes.index');
    }
}
