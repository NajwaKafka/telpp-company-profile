@if($menu->allChildren->where('is_actived', 1)->count() > 0)
    <div class="relative group/submenu">
        <div class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-primary transition-all cursor-pointer group-hover/submenu:translate-x-1">
            <div class="flex items-center gap-3">
                <div class="size-1.5 rounded-full bg-slate-300 group-hover/submenu:bg-primary transition-colors"></div>
                {{ $menu->name }}
            </div>
            <span class="material-symbols-outlined text-sm transition-transform group-hover/submenu:rotate-[-90deg] text-slate-400">arrow_forward_ios</span>
        </div>
        
        <!-- Depth Level 2+ -->
        <div class="absolute top-0 left-full opacity-0 invisible group-hover/submenu:opacity-100 group-hover/submenu:visible transition-all duration-300 z-[70] translate-x-1">
            <div class="min-w-[220px] bg-white rounded-2xl shadow-2xl border border-slate-100 p-2 relative">
                <div class="absolute -top-10 -right-10 size-32 bg-primary/5 rounded-full blur-2xl"></div>
                
                @foreach($menu->allChildren->where('is_actived', 1) as $child)
                    @include('components.header_menu_recursive', ['menu' => $child])
                @endforeach
            </div>
        </div>
    </div>
@else
    <a href="{{ $menu->url }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-primary transition-all group/item">
        <div class="size-1.5 rounded-full bg-slate-300 group-hover/item:bg-primary transition-colors"></div>
        {{ $menu->name }}
    </a>
@endif
