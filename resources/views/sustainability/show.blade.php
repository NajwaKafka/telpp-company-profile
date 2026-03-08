@extends('layouts.app')

@section('content')
<!-- Dynamic Hero Section -->
<section class="relative h-[70vh] flex items-center overflow-hidden bg-slate-950">
    @if($point->cover_image)
        <img src="{{ asset('storage/' . $point->cover_image) }}" class="absolute inset-0 w-full h-full object-cover opacity-50 scale-105" alt="{{ $point->title }}">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10 w-full">
        <div class="max-w-3xl">
            <div class="flex items-center gap-4 mb-8 animate-fade-in-up">
                <div class="size-16 bg-primary rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-primary/40">
                    <span class="material-symbols-outlined text-4xl">{{ $point->icon ?? 'nest_eco_leaf' }}</span>
                </div>
                <span class="text-xs font-black uppercase tracking-[0.4em] text-primary-light bg-primary/10 px-4 py-2 rounded-full border border-primary/20">
                    {{ ucfirst($point->category) }} Initiative
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-tight mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
                {{ $point->title }}
            </h1>
            <div class="flex items-center gap-6 animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="h-px w-20 bg-primary"></div>
                <p class="text-xl text-slate-300 font-medium italic">Our commitment to a sustainable future.</p>
            </div>
        </div>
    </div>
</section>

<!-- Content Narrative -->
<section class="py-32 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
            <!-- Main Story -->
            <div class="lg:col-span-12">
                <div class="prose prose-2xl prose-slate max-w-none">
                    <p class="text-2xl text-slate-600 leading-[1.8] font-medium mb-12 first-letter:text-7xl first-letter:font-black first-letter:text-primary first-letter:mr-3 first-letter:float-left">
                        {{ $point->description }}
                    </p>
                    

                </div>

                <!-- Multi-Image Gallery -->
                @if($point->images->count() > 0)
                <div class="mt-24">
                    <h3 class="text-3xl font-black text-slate-950 tracking-tight mb-12 flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-4xl">photo_library</span>
                        Visual Documentation
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($point->images as $index => $image)
                        <div class="group relative aspect-[4/3] rounded-[2.5rem] overflow-hidden bg-slate-100 {{ $index == 0 ? 'md:col-span-2 aspect-[16/7]' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="Gallery Image">
                            <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>


        </div>
    </div>
</section>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 1s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
</style>
@endsection
