@extends('layouts.app')

@section('title', 'Advanced Process Intelligence - TeLPP')

@section('content')
<section class="relative h-screen w-full bg-[#f8fafc] overflow-hidden pt-20">
    <!-- 3D Canvas -->
    <div id="pulp-3d-canvas-container" class="absolute inset-0 z-0"></div>

    <!-- UI Overlay: System Intelligence Panel -->
    <div class="absolute left-10 top-1/2 -translate-y-1/2 z-20 w-[480px] pointer-events-none">
        <div class="bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-[0_50px_100px_-20px_rgba(15,23,42,0.1)] pointer-events-auto relative">
            
            <!-- Branding -->
            <div class="flex items-center gap-3 mb-8">
                <div class="h-5 w-1.5 bg-primary rounded-full"></div>
                <div id="phase-label" class="text-[11px] font-black uppercase tracking-[0.3em] text-slate-400">PHASE 1 OF 12</div>
            </div>

            <h1 id="stage-title" class="text-4xl font-extrabold text-slate-900 tracking-tighter mb-4 leading-none">Factory Unit</h1>
            <p id="stage-description" class="text-slate-500 text-lg mb-10 leading-relaxed">Processing and optimizing industrial materials.</p>

            <!-- Flow Architecture (Informativity) -->
            <div class="grid grid-cols-2 gap-4 mb-10">
                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block mb-2">Input Material</span>
                    <span id="stage-input" class="text-sm font-bold text-slate-700">Loading...</span>
                </div>
                <div class="p-6 bg-primary/5 rounded-3xl border border-primary/10">
                    <span class="text-[9px] font-black uppercase tracking-widest text-primary block mb-2">Output Result</span>
                    <span id="stage-output" class="text-sm font-bold text-slate-900">Processing...</span>
                </div>
            </div>

            <!-- Technical Dashboard -->
            <div class="bg-slate-950 p-8 rounded-[2rem] mb-12 shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-transparent opacity-50"></div>
                <div class="flex items-center gap-4 mb-4 relative">
                    <span class="material-symbols-outlined text-primary">analytics</span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">System Telemetry</span>
                </div>
                <div id="stage-technical" class="text-base font-bold text-white leading-relaxed relative">
                    Initializing industrial analytics...
                </div>
            </div>

            <!-- Control Systems -->
            <div class="flex items-center gap-4">
                <button id="tour-prev" class="size-16 rounded-2xl bg-slate-50 border border-slate-100 text-slate-400 hover:bg-slate-900 hover:text-white flex items-center justify-center transition-all group active:scale-95">
                    <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">west</span>
                </button>
                <button id="tour-next" class="flex-grow h-16 rounded-2xl bg-slate-950 text-white font-black uppercase tracking-[0.2em] flex items-center justify-center gap-3 hover:bg-primary transition-all shadow-xl active:scale-[0.98]">
                    NEXT FACILITY
                    <span class="material-symbols-outlined text-sm">east</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Timeline Progress Dots -->
    <div class="absolute top-28 left-1/2 -translate-x-1/2 z-30 flex gap-2">
        @for($i=0; $i<12; $i++)
            <div class="timeline-dot size-3 rounded-full bg-slate-200 transition-all duration-500"></div>
        @endfor
    </div>

    <!-- Interface Legend -->
    <div class="absolute bottom-12 right-12 z-20 hidden md:flex items-center gap-6 text-[10px] font-black text-slate-400 uppercase tracking-widest bg-white/80 backdrop-blur px-8 py-4 rounded-full border border-slate-100 shadow-xl">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sm text-primary">api</span>
            Active Flow Lines
        </div>
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-sm text-primary">rotate_90_degrees_ccw</span>
            3D Navigation Active
        </div>
    </div>
</section>

<style>
    @font-face { font-family: 'Inter'; src: url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap'); }
    body { font-family: 'Inter', sans-serif; }
</style>

@push('scripts')
@vite(['resources/js/pulp-3d-process.js'])
@endpush
@endsection
