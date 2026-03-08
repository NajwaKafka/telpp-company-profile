<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsItems = \App\Models\News::latest()->get();
        return view('admin.news.index', compact('newsItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'summary' => 'nullable',
            'content' => 'required',
            'slug' => 'nullable',
            'is_published' => 'boolean',
            'thumbnail' => 'nullable|image',
        ]);

        $data['slug'] = $data['slug'] ?? \Illuminate\Support\Str::slug($data['title']);
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('news', 'public');
        }

        \App\Models\News::create($data);
        return redirect()->route('admin.news.index')->with('success', 'News published.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = \App\Models\News::findOrFail($id);
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, string $id)
    {
        $news = \App\Models\News::findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'summary' => 'nullable',
            'content' => 'required',
            'slug' => 'nullable',
            'is_published' => 'nullable',
            'thumbnail' => 'nullable|image',
        ]);

        $data['slug'] = $data['slug'] ?? \Illuminate\Support\Str::slug($data['title']);
        $data['is_published'] = $request->has('is_published');
        if ($data['is_published'] && !$news->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('news', 'public');
        }

        $news->update($data);
        return redirect()->route('admin.news.index')->with('success', 'News updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\News::destroy($id);
        return redirect()->route('admin.news.index')->with('success', 'News deleted.');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            try {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                
                // Validate extension
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    return response()->json(['error' => ['message' => 'Invalid file extension. Allowed: ' . implode(', ', $allowedExtensions)]]);
                }

                $fileName = \Illuminate\Support\Str::slug($fileName) . '_' . time() . '.' . $extension;

                $destPath = public_path('media');
                if (!file_exists($destPath)) {
                    mkdir($destPath, 0755, true);
                }

                $request->file('upload')->move($destPath, $fileName);

                $url = asset('media/' . $fileName);
                return response()->json(['url' => $url]);
            } catch (\Exception $e) {
                return response()->json(['error' => ['message' => 'Upload failed: ' . $e->getMessage()]]);
            }
        }
        return response()->json(['error' => ['message' => 'No file uploaded.']]);
    }
}
