<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
     public function index()
    {
        $data = News::where('is_published', true)->latest()->get();
        return view('news', compact('data'));
    }

    public function show($slug)
    {
        $news = News::with('images')->where('slug', $slug)->firstOrFail();
        return view('news.show', compact('news'));
    }
}