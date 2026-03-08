@extends('layouts.admin')

@section('title', 'Editor: Corporate News')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-12 flex items-center gap-4">
        <a href="{{ route('admin.news.index') }}" class="size-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900">{{ isset($news) ? 'Edit News Entry' : 'Write New Article' }}</h2>
            <p class="text-slate-500 font-medium">Broadcast your corporate updates to the world.</p>
        </div>
    </div>

    <form action="{{ isset($news) ? route('admin.news.update', $news->id) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        @csrf
        @if(isset($news)) @method('PUT') @endif

        <div class="lg:col-span-2 space-y-8">
            <div class="p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Article Title</label>
                    <input type="text" name="title" value="{{ $news->title ?? '' }}" placeholder="Enter a compelling headline" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none text-xl font-black text-slate-900" required>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Summary (SEO Tip: Short & Sweet)</label>
                    <textarea name="summary" rows="3" placeholder="Engagement summary for social sharing..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600">{{ $news->summary ?? '' }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Main Content</label>
                    <textarea name="content" rows="15" placeholder="Tell the full story here..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600">{{ $news->content ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Settings</label>
                
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 ml-2">Slug (Auto-generated if empty)</label>
                    <input type="text" name="slug" value="{{ $news->slug ?? '' }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-transparent text-sm font-bold text-slate-600">
                </div>

                <div class="flex items-center gap-4 py-2">
                    <input type="checkbox" name="is_published" value="1" id="is_published" {{ (isset($news) && !$news->is_published) ? '' : 'checked' }} class="size-6 rounded-lg text-primary focus:ring-primary border-slate-200">
                    <label for="is_published" class="font-bold text-slate-600">Publish Immediately</label>
                </div>
            </div>

            <div class="p-8 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Thumbnail Image</label>
                <div id="thumbnail-preview" class="size-full aspect-video rounded-2xl bg-slate-50 border-2 border-dashed border-slate-100 flex items-center justify-center text-slate-300 relative overflow-hidden group">
                    @if(isset($news) && $news->thumbnail_path)
                        <img src="{{ asset('storage/' . $news->thumbnail_path) }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                    @endif
                    <input type="file" name="thumbnail" onchange="previewThumbnail(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            <button type="submit" class="w-full py-6 bg-primary text-white rounded-[2.5rem] font-black shadow-xl shadow-primary/20 hover:scale-[1.02] transition-all">
                Submit Article
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewThumbnail(input) {
        const container = document.getElementById('thumbnail-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <input type="file" name="thumbnail" onchange="previewThumbnail(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
