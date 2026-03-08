@if($menu->allChildren->where('is_actived', 1)->count() > 0)
    <div class="flex flex-col w-full">
        <button onclick="toggleMobileAccordion(this)" class="w-full py-4 flex items-center justify-between transition-colors text-left group/btn">
            <div class="flex items-center gap-3">
                @if($level > 0)
                    <div class="size-1.5 rounded-full bg-gold-accent/60 shadow-[0_0_8px_rgba(234,179,8,0.3)]"></div>
                @endif
                <span class="{{ $level == 0 ? 'text-2xl font-black uppercase tracking-tighter text-white' : 'text-lg font-bold text-slate-50 tracking-wide' }}">
                    {{ $menu->name }}
                </span>
            </div>
            <span class="material-symbols-outlined text-slate-400 text-xl transition-transform group-hover/btn:text-gold-accent icon-expand">add</span>
        </button>
        <div class="grid grid-rows-[0fr] transition-all duration-500 ease-in-out border-l border-white/10 ml-{{ $level == 0 ? '2' : '4' }} mb-2 accordion-content">
            <div class="overflow-hidden">
                <div class="pl-5 flex flex-col">
                    @foreach($menu->allChildren->where('is_actived', 1) as $child)
                        @include('components.header_mobile_menu_recursive', ['menu' => $child, 'level' => $level + 1])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <a href="{{ $menu->url }}" class="block py-3.5 flex items-center gap-3 transition-colors group/link">
        @if($level > 0)
            <div class="size-1 rounded-full bg-slate-500 group-hover/link:bg-gold-accent transition-colors"></div>
        @endif
        <span class="{{ $level == 0 ? 'text-2xl font-black uppercase tracking-tighter text-white' : 'text-[15px] font-semibold text-slate-200 tracking-wide group-hover/link:text-white group-hover/link:translate-x-1 transition-all' }}">
            {{ $menu->name }}
        </span>
    </a>
@endif
