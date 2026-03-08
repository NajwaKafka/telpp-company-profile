@extends('layouts.admin')

@section('title', 'Editor: Company Creed')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-12 flex items-center gap-4">
        <a href="{{ route('admin.creeds.index') }}" class="size-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900">{{ isset($creed) ? 'Edit Creed' : 'Define New Creed' }}</h2>
            <p class="text-slate-500 font-medium">Capture the spiritual essence of the brand values.</p>
        </div>
    </div>

    <form action="{{ isset($creed) ? route('admin.creeds.update', $creed->id) : route('admin.creeds.store') }}" method="POST" class="space-y-8">
        @csrf
        @if(isset($creed)) @method('PUT') @endif

        <div class="p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Japanese Character</label>
                    <input type="text" name="title_jp" value="{{ $creed->title_jp ?? '' }}" placeholder="e.g. 和" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none text-3xl font-['Shippori_Mincho_B1'] text-slate-900 text-center" maxlength="5" required>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">English Title</label>
                    <input type="text" name="title_en" value="{{ $creed->title_en ?? '' }}" placeholder="e.g. Harmony" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-black text-slate-900">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Tagline (Verbatim quote)</label>
                <input type="text" name="tagline" value="{{ $creed->tagline ?? '' }}" placeholder="e.g. To respect each other and cooperate." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-bold text-slate-900 italic">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Detailed Description</label>
                <textarea name="description" rows="5" placeholder="Deep dive into the value..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600">{{ $creed->description ?? '' }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Display Order</label>
                    <input type="number" name="order" value="{{ $creed->order ?? 0 }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-bold text-slate-900 text-center">
                </div>
                <div class="flex items-center gap-4 px-6">
                    <input type="checkbox" name="is_active" value="1" id="is_active" {{ (isset($creed) && !$creed->is_active) ? '' : 'checked' }} class="size-6 rounded-lg text-primary focus:ring-primary border-slate-200">
                    <label for="is_active" class="font-bold text-slate-600">Active and Visible</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl font-black shadow-xl shadow-primary/20 hover:scale-105 transition-all">
                Save Creed Item
            </button>
        </div>
    </form>
</div>
@endsection
