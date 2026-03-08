@extends('layouts.app')

@section('title', $news->title . ' - PulpCo News')

@section('content')
<article class="min-h-screen bg-slate-50 pt-32 pb-24">
    <div class="max-w-4xl mx-auto px-6">
        
        <!-- Breadcrumbs & Category -->
        <div class="flex items-center gap-4 mb-8">
            <a href="/" class="text-sm font-medium text-slate-500 hover:text-primary transition-colors">Home</a>
            <span class="text-slate-300">/</span>
            <a href="/news" class="text-sm font-medium text-slate-500 hover:text-primary transition-colors">News</a>
            <span class="text-slate-300">/</span>
            <span class="text-sm font-bold text-primary uppercase tracking-wider">
                {{ $news->category ?? 'Media Release' }}
            </span>
        </div>

        <!-- Title Section -->
        <header class="mb-12">
            <h1 class="text-4xl md:text-6xl font-black text-slate-900 leading-[1.1] mb-8">
                {{ $news->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 text-slate-500 border-y border-slate-200 py-6">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">calendar_today</span>
                    <span class="text-sm font-medium">
                        {{ $news->published_at ? $news->published_at->format('F d, Y') : $news->created_at->format('F d, Y') }}
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <span class="text-sm font-medium">Admin PulpCo</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    <span class="text-sm font-medium">5 min read</span>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        @if($news->thumbnail_path)
        <div class="relative group rounded-3xl overflow-hidden shadow-2xl mb-16 h-[500px]">
            <img src="{{ asset('storage/' . $news->thumbnail_path) }}" 
                 alt="{{ $news->title }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
        </div>
        @endif

        <!-- Content -->
        <div class="prose prose-slate prose-lg max-w-none text-slate-700 leading-relaxed">
            {!! $news->content !!}
        </div>

        <!-- Photo Gallery if exists -->
        @if($news->images && $news->images->count() > 0)
        <div class="mt-20">
            <h3 class="text-2xl font-bold mb-8 flex items-center gap-3">
                <span class="w-8 h-1 bg-primary"></span>
                Event Gallery
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($news->images as $image)
                <div class="rounded-2xl overflow-hidden aspect-video shadow-lg">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Share & Back -->
        <footer class="mt-20 pt-12 border-t border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="flex items-center gap-4">
                <p class="font-bold text-slate-900">Share this story:</p>
                <div class="flex gap-2">
                    <button class="size-10 rounded-full bg-slate-200 flex items-center justify-center hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined text-sm">share</span>
                    </button>
                    <!-- Add more social icons as needed -->
                </div>
            </div>

            <a href="/#news-section" class="inline-flex items-center gap-2 px-8 py-3 bg-slate-900 text-white rounded-full font-bold hover:bg-primary transition-all shadow-xl hover:-translate-y-1">
                <span class="material-symbols-outlined">arrow_back</span>
                Back to All News
            </a>
        </footer>

    </div>
</article>

<style>
    .prose h2 { font-weight: 800; color: #0f172a; margin-top: 2em; }
    .prose p { margin-bottom: 1.5em; }
    .prose strong { color: #0f172a; }
</style>
@endsection
