<div class="group/parent bg-white border border-slate-200 rounded-3xl overflow-hidden hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500 mb-6 last:mb-0">
    <div class="p-8 flex items-center justify-between {{ $menu->parent_id ? 'bg-slate-50/30' : 'bg-slate-50/50' }}">
        <div class="flex items-center gap-6">
            <div class="size-14 bg-white border border-slate-100 rounded-2xl flex items-center justify-center text-slate-400 group-hover/parent:text-primary transition-colors shadow-sm">
                <span class="material-symbols-outlined text-3xl">{{ $menu->parent_id ? 'subdirectory_arrow_right' : 'menu' }}</span>
            </div>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">{{ $menu->name }}</h3>
                    @if(!$menu->parent_id)
                        <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest rounded-full">Primary</span>
                    @endif
                    @if(!$menu->is_actived)
                        <span class="px-3 py-1 bg-slate-100 text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-full">Inactive</span>
                    @endif
                </div>
                <p class="text-slate-400 text-sm font-medium">{{ $menu->url }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="size-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:text-primary hover:border-primary/20 hover:shadow-lg transition-all">
                <span class="material-symbols-outlined text-xl">edit_square</span>
            </a>
            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete all sub-menus too.')">
                @csrf
                @method('DELETE')
                <button class="size-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 hover:text-red-500 hover:border-red-100 hover:bg-red-50 hover:shadow-lg transition-all">
                    <span class="material-symbols-outlined text-xl">delete</span>
                </button>
            </form>
        </div>
    </div>

    @if($menu->allChildren->count() > 0)
        <div class="px-8 pb-8 pt-4 space-y-4">
            @foreach($menu->allChildren as $child)
                <div class="pl-8 border-l-2 border-slate-100">
                    @include('admin.menus.item', ['menu' => $child])
                </div>
            @endforeach
        </div>
    @endif
</div>
