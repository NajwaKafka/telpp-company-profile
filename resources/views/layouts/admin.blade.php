<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Scripts -->
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Inter'] bg-slate-50 text-slate-900 antialiased h-screen overflow-hidden flex">
    <!-- Sidebar: Minimalist Elite -->
    <aside class="w-72 bg-slate-950 text-white flex flex-col shrink-0 relative border-r border-white/5 shadow-2xl">
        <!-- Logo -->
        <div class="px-8 py-10 flex items-center gap-3">
            <div class="size-10 bg-primary ring-4 ring-primary/20 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">forest</span>
            </div>
            <div class="flex flex-col">
                <span class="text-lg font-black tracking-tight leading-none uppercase">TeLpp</span>
                <span class="text-[8px] font-black uppercase tracking-[0.3em] text-primary/80 mt-1">Management Profile</span>
            </div>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto custom-scrollbar">
            <!-- Label -->
            <div class="px-6 pb-2 pt-4">
                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-600">Overview</span>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-6 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-2xl {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'group-hover:text-primary' }}">dashboard</span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>

            <!-- Label -->
            <div class="px-6 pb-2 pt-8">
                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-600">Content Engine</span>
            </div>
            
            <a href="{{ route('admin.company.index') }}" class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.company.*') ? 'bg-white/10 text-white' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-2xl {{ request()->routeIs('admin.company.*') ? 'text-primary' : 'group-hover:text-primary' }}">business_center</span>
                <span class="text-[12px] font-bold whitespace-nowrap">Company Profile</span>
            </a>

            <a href="{{ route('admin.creeds.index') }}" class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.creeds.*') ? 'bg-white/10 text-white' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-2xl {{ request()->routeIs('admin.creeds.*') ? 'text-primary' : 'group-hover:text-primary' }}">verified</span>
                <span class="text-[12px] font-bold whitespace-nowrap">Company Creed</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.products.*') ? 'bg-white/10 text-white' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-2xl {{ request()->routeIs('admin.products.*') ? 'text-primary' : 'group-hover:text-primary' }}">inventory_2</span>
                <span class="text-[12px] font-bold whitespace-nowrap">Products</span>
            </a>

            <a href="{{ route('admin.sustainabilities.index') }}" class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.sustainabilities.*') ? 'bg-white/10 text-white' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-2xl {{ request()->routeIs('admin.sustainabilities.*') ? 'text-primary' : 'group-hover:text-primary' }}">nest_eco_leaf</span>
                <span class="text-[12px] font-bold whitespace-nowrap">Sustainability</span>
            </a>

            <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.news.*') ? 'bg-white/10 text-white' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-2xl {{ request()->routeIs('admin.news.*') ? 'text-primary' : 'group-hover:text-primary' }}">description</span>
                <span class="text-[12px] font-bold whitespace-nowrap">Corporate News</span>
            </a>

            <a href="{{ route('admin.menus.index') }}" class="flex items-center gap-3 px-6 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.menus.*') ? 'bg-white/10 text-white' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined text-2xl {{ request()->routeIs('admin.menus.*') ? 'text-primary' : 'group-hover:text-primary' }}">account_tree</span>
                <span class="text-[12px] font-bold whitespace-nowrap">Header Menus</span>
            </a>
        </nav>

        <!-- User Section At Bottom -->
        <div class="px-4 py-8 border-t border-white/5 bg-slate-900/40">
            <div class="px-6 py-4 bg-white/5 rounded-2xl flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="size-10 rounded-xl bg-slate-800 flex items-center justify-center text-primary font-bold">A</div>
                    <div>
                        <p class="text-xs font-black text-white">Administrator</p>
                        <p class="text-[9px] font-bold text-slate-500 truncate">TeLpp Portal</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="size-8 rounded-lg bg-white/5 hover:bg-primary hover:text-white flex items-center justify-center text-slate-500 transition-all">
                        <span class="material-symbols-outlined text-lg">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto relative bg-[#fcfcfd]">
        <!-- Header -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-xl border-b border-slate-200 px-10 py-6 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-primary">Admin System</span>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">@yield('title', 'Admin Dashboard')</h1>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-black text-slate-900 uppercase tracking-widest">{{ now()->format('l') }}</p>
                    <p class="text-[10px] font-bold text-slate-400 capitalize">{{ now()->format('M d, Y') }}</p>
                </div>
                <div class="size-10 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400">
                    <span class="material-symbols-outlined">account_circle</span>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-10">
            @yield('content')
        </div>
    </main>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); border-radius: 10px; }
    </style>
    @stack('scripts')
</body>
</html>
