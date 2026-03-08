@extends('layouts.admin')

@section('title', 'Header Menus')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xs font-black uppercase tracking-[0.3em] text-primary mb-2">Navigation Engine</h2>
            <p class="text-slate-500 text-sm">Organize your site's header navigation and sub-menus.</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="flex items-center gap-3 bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined">add_circle</span>
            Add Menu Item
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1">
        @forelse($menus as $menu)
            @include('admin.menus.item', ['menu' => $menu])
        @empty
            <div class="bg-white border-2 border-dashed border-slate-200 rounded-[3rem] p-24 text-center">
                <div class="size-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-slate-100">
                    <span class="material-symbols-outlined text-5xl text-slate-200">account_tree</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">No Menus Defined</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-10">Start by creating your first primary menu item to build your site's navigation structure.</p>
                <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center gap-3 bg-primary text-white px-10 py-5 rounded-2xl font-black transition-all shadow-xl shadow-primary/20 hover:scale-105 active:scale-95">
                    <span class="material-symbols-outlined">add</span>
                    Create First Menu
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
