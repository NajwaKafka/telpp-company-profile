<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $data = News::where('is_published', true)->latest()->paginate(6);
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.news.news_cards_partial', compact('data'))->render(),
                'hasMore' => $data->hasMorePages()
            ]);
        }
        
        return view('news', compact('data'));
    }

    public function show($slug)
    {
        $news = News::with('images')->where('slug', $slug)->firstOrFail();
        return view('news.show', compact('news'));
    }
}