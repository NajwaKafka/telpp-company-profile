@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- Stat Cards -->
    <div class="p-8 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm space-y-4">
        <div class="size-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary">
            <span class="material-symbols-outlined text-2xl">visibility</span>
        </div>
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Visits</p>
            <p class="text-3xl font-black text-slate-900">12.8K</p>
        </div>
        <p class="text-[10px] font-medium text-green-500 flex items-center gap-1">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            +14.5% compared to last mo.
        </p>
    </div>

    <div class="p-8 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm space-y-4">
        <div class="size-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 font-black">
            <span class="material-symbols-outlined text-2xl">newspaper</span>
        </div>
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Published News</p>
            <p class="text-3xl font-black text-slate-900">42</p>
        </div>
        <p class="text-[10px] font-medium text-slate-400">Current active announcements.</p>
    </div>

    <div class="p-8 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm space-y-4">
        <div class="size-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 font-black">
            <span class="material-symbols-outlined text-2xl">inventory_2</span>
        </div>
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Products</p>
            <p class="text-3xl font-black text-slate-900">08</p>
        </div>
        <p class="text-[10px] font-medium text-slate-400">Pulp mill product categories.</p>
    </div>

    <div class="p-8 rounded-[2.5rem] bg-primary text-white shadow-xl shadow-primary/20 space-y-4">
        <div class="size-12 rounded-2xl bg-white/10 flex items-center justify-center text-white font-black">
            <span class="material-symbols-outlined text-2xl">verified_user</span>
        </div>
        <div>
            <p class="text-[10px] font-black uppercase tracking-widest text-white/60">System Status</p>
            <p class="text-3xl font-black">Secure</p>
        </div>
        <p class="text-[10px] font-medium text-white/80">Everything is running smoothly.</p>
    </div>
</div>

<div class="mt-12 p-12 bg-slate-900 rounded-[3.5rem] text-white relative overflow-hidden group">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(22,101,52,0.2)_0%,transparent_100%)]"></div>
    <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
        <div class="shrink-0">
            <div class="size-32 rounded-full border-2 border-primary/30 flex items-center justify-center text-primary bg-slate-900 relative">
                <span class="material-symbols-outlined text-6xl">waving_hand</span>
            </div>
        </div>
        <div class="space-y-4">
            <h2 class="text-3xl font-black">Welcome back, Administrator.</h2>
            <p class="text-slate-400 max-w-2xl text-lg font-light leading-relaxed">
                Use the sidebar to manage your company's digital narrative. You can update historical records, modify the company creed, or publish new updates to your global stakeholders.
            </p>
        </div>
    </div>
</div>
@endsection
