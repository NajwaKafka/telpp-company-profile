<!-- Navigation Bar (Elite Glassmorphism) -->
<header class="sticky top-0 z-50 bg-white/70 backdrop-blur-2xl border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="flex items-center justify-between h-20">
            <!-- Global Brand Identity -->
            <div class="flex items-center gap-4 group cursor-pointer transition-all hover:scale-105">
                <div class="bg-primary p-2.5 rounded-xl shadow-2xl shadow-primary/30 group-hover:rotate-12 transition-all duration-500 ring-4 ring-primary/5">
                    <span class="material-symbols-outlined text-white text-xl material-symbols-filled">nest_eco_leaf</span>
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-2xl font-black tracking-tighter text-slate-950 drop-shadow-sm">TeLpp.</span>
                </div>
            </div>

            <!-- Dynamic Recursive Navigation -->
            <nav class="hidden lg:flex items-center gap-10">
                @foreach($menus as $menu)
                @if($menu->children->count() > 0)
                <div class="relative group">
                    <button class="flex items-center gap-1.5 text-[11px] font-black uppercase tracking-widest text-slate-600 hover:text-primary transition-all group-hover:text-primary group-hover:translate-y-[-1px]">
                        {{ $menu->name }}
                        <span class="material-symbols-outlined text-base transition-transform group-hover:rotate-180">keyboard_arrow_down</span>
                    </button>
                    <!-- Enhanced Dropdown -->
                    <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible scale-95 group-hover:opacity-100 group-hover:visible group-hover:scale-100 transition-all duration-300 z-50">
                        <div class="min-w-[240px] bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-100 p-4 relative">
                            <div class="absolute -top-12 -right-12 size-40 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
                            @foreach($menu->allChildren->where('is_actived', 1) as $child)
                                @include('components.header_menu_recursive', ['menu' => $child])
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                <a class="text-[11px] font-black uppercase tracking-widest text-slate-600 hover:text-primary transition-all relative group group-hover:translate-y-[-1px]" href="{{ $menu->url }}">
                    {{ $menu->name }}
                    <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                </a>
                @endif
                @endforeach
            </nav>

            <!-- Corporate Actions -->
            <div class="flex items-center gap-4">
                <div class="hidden xl:flex items-center gap-2 p-1.5 bg-slate-100 rounded-2xl border border-slate-200">
                    <button class="h-10 px-6 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-700 hover:bg-white hover:text-primary hover:shadow-sm transition-all duration-300">
                        e-procurement
                    </button>
                    <button class="h-10 px-6 rounded-xl bg-primary text-white text-[10px] font-black uppercase tracking-widest shadow-xl shadow-primary/25 hover:bg-primary/90 hover:scale-105 transition-all duration-300">
                        e-recruitment
                    </button>
                </div>
                <!-- Mobile Trigger -->
                <button id="mobileMenuTrigger" class="lg:hidden text-slate-900 size-12 flex items-center justify-center bg-slate-100 rounded-2xl active:scale-95 transition-transform">
                    <span class="material-symbols-outlined">menu_open</span>
                </button>
            </div>
        </div>
    </div>

</header>

<!-- Mobile Navigation Overlay (Elite Nature Harmony) -->
<div id="mobileMenu" class="fixed inset-0 z-[100] bg-[#022c22] translate-x-full transition-transform duration-700 lg:hidden overflow-y-auto">
    <style>
        #mobileMenu:not(.translate-x-full) .mobile-nav-item {
            opacity: 1 !important;
            transform: translateX(0) !important;
        }
        .mobile-nav-item {
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>

    <!-- Background Atmosphere -->
    <div class="absolute top-0 right-0 w-full h-full bg-primary/20 blur-[150px] rounded-full pointer-events-none opacity-50"></div>
    
    <div class="relative flex flex-col min-h-full p-8 z-10">
        <!-- Mobile Header -->
        <div class="flex items-center justify-between mb-12">
            <div class="flex items-center gap-3">
                <div class="bg-primary p-2.5 rounded-xl shadow-[0_0_20px_rgba(34,197,94,0.3)]">
                    <span class="material-symbols-outlined text-white text-lg material-symbols-filled">nest_eco_leaf</span>
                </div>
                <span class="text-2xl font-black tracking-tighter text-white uppercase drop-shadow-sm">TeLpp.</span>
            </div>
            <button id="mobileMenuClose" class="size-12 flex items-center justify-center bg-white/10 border border-white/20 rounded-2xl text-white hover:bg-white/20 transition-all">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Dynamic Mobile Navigation -->
        <nav class="flex flex-col divide-y divide-white/5">
            @foreach($menus as $index => $menu)
            <div class="mobile-nav-item" style="transition-delay: {{ 100 + ($index * 70) }}ms">
                @include('components.header_mobile_menu_recursive', ['menu' => $menu, 'level' => 0])
            </div>
            @endforeach
        </nav>

        <!-- Corporate Actions Mobile -->
        <div class="mt-auto pt-16 mobile-nav-item" style="transition-delay: {{ 150 + ($menus->count() * 70) }}ms">
            <div class="flex flex-col gap-4">
                <button class="h-16 w-full rounded-2xl bg-primary text-white font-black uppercase tracking-widest shadow-2xl shadow-primary/30 flex items-center justify-center gap-3">
                    e-recruitment
                    <span class="material-symbols-outlined text-sm">rocket_launch</span>
                </button>
                <button class="h-16 w-full rounded-2xl bg-white/5 border border-white/10 text-slate-300 font-black uppercase tracking-widest backdrop-blur-md">
                    e-procurement
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMobileAccordion(btn) {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('.icon-expand');
        
        content.classList.toggle('grid-rows-[1fr]');
        content.classList.toggle('grid-rows-[0fr]');
        
        const isOpen = content.classList.contains('grid-rows-[1fr]');
        
        if (isOpen) {
            icon.style.transform = 'rotate(45deg)';
            icon.innerText = 'close';
            btn.classList.add('text-gold-accent');
        } else {
            icon.style.transform = 'rotate(0deg)';
            icon.innerText = 'add';
            btn.classList.remove('text-gold-accent');
        }
    }
</script>
