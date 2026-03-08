@extends('layouts.admin')

@section('title', 'Company Creed Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Values & Creeds</h2>
            <p class="text-slate-500 font-medium">Manage the spiritual core of the brand: Fairness, Innovation, Harmony.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.company.index') }}" class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                <span class="material-symbols-outlined">settings</span>
                Global Statement
            </a>
            <a href="{{ route('admin.creeds.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined">add</span>
                New Creed Item
            </a>
        </div>
    </div>

    @php
        $profile = \App\Models\CompanyProfile::latest()->first();
    @endphp
    @if($profile && $profile->creed_statement)
    <div class="p-8 rounded-[2.5rem] bg-slate-900 text-white relative overflow-hidden group">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(22,101,52,0.2)_0%,transparent_100%)]"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="space-y-2">
                <span class="text-primary font-black uppercase tracking-[0.5em] text-[10px]">Active Global Statement</span>
                <p class="text-xl md:text-2xl font-medium leading-relaxed italic text-slate-200 max-w-4xl">
                    "{{ $profile->creed_statement }}"
                </p>
            </div>
            <a href="{{ route('admin.company.edit', $profile->id) }}" class="shrink-0 px-6 py-3 bg-white/10 hover:bg-white/20 border border-white/10 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                Change Statement
            </a>
        </div>
    </div>
    @endif


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($creeds as $creed)
        <div class="p-8 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
            <div class="flex justify-between items-start mb-6">
                <div class="size-16 rounded-2xl bg-primary/5 flex items-center justify-center text-primary text-4xl font-['Shippori_Mincho_B1'] select-none">
                    {{ $creed->title_jp }}
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.creeds.edit', $creed->id) }}" class="size-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </a>
                </div>
            </div>
            <div class="space-y-4">
                <h3 class="text-xl font-black text-slate-900">{{ $creed->title_en }}</h3>
                <p class="text-xs font-bold italic text-primary uppercase tracking-widest">{{ $creed->tagline }}</p>
                <p class="text-sm text-slate-500 leading-relaxed line-clamp-3">{{ $creed->description }}</p>
            </div>
            <div class="mt-8 pt-6 border-t border-slate-50 flex items-center justify-between">
                <span class="text-[10px] font-black uppercase tracking-widest {{ $creed->is_active ? 'text-green-500' : 'text-slate-300' }}">
                    {{ $creed->is_active ? 'Active' : 'Inactive' }}
                </span>
                <span class="text-[10px] font-bold text-slate-300">Order: {{ $creed->order }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-full p-20 text-center bg-white rounded-[2.5rem] border border-slate-100">
            <div class="flex flex-col items-center gap-4">
                <span class="material-symbols-outlined text-6xl text-slate-200">format_quote</span>
                <p class="text-slate-400 font-medium">No creeds found. Define your company values.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
