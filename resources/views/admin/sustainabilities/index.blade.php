@extends('layouts.admin')

@section('title', 'Sustainability Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xs font-black uppercase tracking-[0.3em] text-primary mb-2">Impact Ledger</h2>
            <p class="text-slate-500 text-sm">Manage environmental, social, and corporate sustainability initiatives.</p>
        </div>
        <a href="{{ route('admin.sustainabilities.create') }}" class="flex items-center gap-3 bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined">add_circle</span>
            Add Initiative
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl flex items-center gap-3 animate-fade-in">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($sustainabilities as $item)
            <div class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden group hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 flex flex-col h-full">
                <!-- Image Header -->
                <div class="h-48 relative overflow-hidden bg-slate-100 shrink-0">
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $item->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <span class="material-symbols-outlined text-6xl">image_not_supported</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 text-white text-[10px] font-black uppercase tracking-widest rounded-full">
                            {{ $item->category }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 flex flex-col flex-1">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-primary text-2xl">{{ $item->icon ?? 'spa' }}</span>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight line-clamp-1">{{ $item->title }}</h3>
                    </div>
                    
                    <p class="text-slate-500 text-sm font-medium line-clamp-3 mb-8 flex-1">
                        {{ $item->description }}
                    </p>

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="size-2 rounded-full {{ $item->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.sustainabilities.edit', $item->id) }}" class="p-2 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined">edit_square</span>
                            </a>
                            <form action="{{ route('admin.sustainabilities.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this initiative?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white border-2 border-dashed border-slate-200 rounded-[3rem] p-24 text-center">
                <div class="size-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-slate-100">
                    <span class="material-symbols-outlined text-5xl text-slate-200">nest_eco_leaf</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-2">No Initiatives Recorded</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-10">Document your company's commitment to the environment and society here.</p>
                <a href="{{ route('admin.sustainabilities.create') }}" class="inline-flex items-center gap-3 bg-primary text-white px-10 py-5 rounded-2xl font-black transition-all shadow-xl shadow-primary/20 hover:scale-105 active:scale-95">
                    <span class="material-symbols-outlined">add</span>
                    Create First Record
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
