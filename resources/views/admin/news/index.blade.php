@extends('layouts.admin')

@section('title', 'News & Announcements')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Corporate Updates</h2>
            <p class="text-slate-500 font-medium">Keep your stakeholders informed with the latest brand news.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
            <span class="material-symbols-outlined">add</span>
            Write News
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="divide-y divide-slate-100">
            @forelse($newsItems as $news)
            <div class="p-8 flex items-center justify-between hover:bg-slate-50/50 transition-all group">
                <div class="flex items-center gap-8">
                    <div class="size-24 rounded-2xl bg-slate-100 overflow-hidden shrink-0">
                        @if($news->thumbnail_path)
                            <img src="{{ asset('storage/' . $news->thumbnail_path) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <span class="material-symbols-outlined">newspaper</span>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-[9px] font-black uppercase tracking-widest text-slate-400">
                                Corporate
                            </span>
                            <span class="text-[10px] font-medium text-slate-400 italic">
                                {{ $news->published_at ? $news->published_at->format('M d, Y') : 'Draft' }}
                            </span>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 group-hover:text-primary transition-colors">{{ $news->title }}</h3>
                        <p class="text-sm text-slate-500 font-medium line-clamp-1 max-w-2xl">{{ $news->summary }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.news.edit', $news->id) }}" class="size-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="size-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-20 text-center">
                <div class="flex flex-col items-center gap-4">
                    <span class="material-symbols-outlined text-6xl text-slate-200">drafts</span>
                    <p class="text-slate-400 font-medium">No news items found. Start writing your corporate story.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
