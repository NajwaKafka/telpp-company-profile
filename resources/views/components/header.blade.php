<!-- Navigation Bar -->
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center gap-4">
                <div class="bg-primary p-2.5 rounded-xl shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-white text-2xl">forest</span>
                </div>
                <span class="text-2xl font-black tracking-tight text-forest-dark">Telpp</span>
            </div>
            <nav class="hidden md:flex items-center gap-10">
                @foreach($menus as $menu)
                <a class="text-sm font-bold text-slate-600 hover:text-primary transition-all relative group" href="{{ $menu->url }}">
                    {{ $menu->name }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                </a>
                @endforeach
            </nav>
            <div class="flex items-center gap-4">
                <button class="hidden lg:flex items-center justify-center rounded-xl h-11 px-6 bg-primary text-white text-sm font-bold hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/30 transition-all">
                    e-procurement
                </button>
                <button class="hidden lg:flex items-center justify-center rounded-xl h-11 px-6 bg-slate-100 text-slate-700 text-sm font-bold hover:bg-slate-200 transition-all">
                    e-recruitment
                </button>
                <button class="md:hidden text-slate-900 p-2 hover:bg-slate-100 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </div>
</header>
