@extends('layouts.admin')

@section('title', 'Editor: Corporate Narrative')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-12 flex items-center gap-4">
        <a href="{{ route('admin.company.index') }}" class="size-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900">Edit Profile</h2>
            <p class="text-slate-500 font-medium">Update the historical narrative and key metrics.</p>
        </div>
    </div>

    <form action="{{ isset($profile) ? route('admin.company.update', $profile->id) : route('admin.company.store') }}" method="POST" class="space-y-8">
        @csrf
        @if(isset($profile)) @method('PUT') @endif

        <div class="p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
            <div class="space-y-4">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400">Section 1: Legacy Header</label>
                <div class="grid grid-cols-1 gap-6">
                    <input type="text" name="history_title" value="{{ $profile->history_title ?? '' }}" placeholder="History Headline (e.g. Evolving Excellence)" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none font-bold text-slate-900">
                    <textarea name="history_description" rows="10" placeholder="Full historical narrative of the company..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600 leading-relaxed">{{ $profile->history_description ?? '' }}</textarea>
                </div>

                <div class="space-y-2">
                    <p class="text-[10px] font-bold text-slate-400 ml-2 uppercase tracking-widest">Creed General Statement</p>
                    <textarea name="creed_statement" rows="3" placeholder="To Achieve sustainable growth..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600">{{ $profile->creed_statement ?? '' }}</textarea>
                </div>
            </div>

        </div>

        <div class="flex justify-end gap-4">
            <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl font-black shadow-xl shadow-primary/20 hover:scale-105 transition-all">
                Save Profile
            </button>
        </div>
    </form>
</div>
@endsection
