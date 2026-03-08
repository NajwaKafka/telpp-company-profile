<!-- Our Company Component (Ultra-Minimalist Corporate) -->
<div id="our-company" class="bg-white">
    <!-- Part 1: Corporate Legacy -->
    <section class="py-32 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">
                <!-- Left Label -->
                <div class="lg:col-span-3 pt-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2.5 h-2.5 bg-primary rounded-full shadow-[0_0_10px_rgba(5,150,105,0.4)]"></div>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-500">Section 01</span>
                    </div>
                    <h2 class="text-xs font-black uppercase tracking-[0.6em] text-slate-950 border-l-2 border-primary pl-4">Legacy & History</h2>
                </div>

                <!-- Right Content -->
                <div class="lg:col-span-9 space-y-12">
                    <h3 class="text-5xl md:text-8xl font-black text-slate-950 leading-[0.9] tracking-tighter drop-shadow-sm">
                        {{ $profile?->history_title ?? 'Evolving Excellence.' }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                        <div class="md:col-span-10 text-xl md:text-2xl text-slate-700 leading-relaxed font-medium">
                            <p class="mb-8">
                                {!! nl2br(e($profile?->history_description ?? 'The historical narrative is being prepared.')) !!}
                            </p>
                        </div>
                        <div class="md:col-span-2 hidden md:block">
                            <div class="text-[100px] font-['Shippori_Mincho_B1'] text-slate-50 leading-none select-none">
                                志
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Part 2: Corporate Philosophy -->
    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <!-- Subtle Glow -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-primary/5 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start mb-24">
                <div class="lg:col-span-3 pt-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2.5 h-2.5 bg-primary rounded-full shadow-[0_0_10px_rgba(5,150,105,0.4)]"></div>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-500">Section 02</span>
                    </div>
                    <h2 class="text-xs font-black uppercase tracking-[0.6em] text-slate-950 border-l-2 border-primary pl-4">The Creed</h2>
                </div>

                <div class="lg:col-span-9 flex flex-col items-center lg:items-start space-y-6">
                    <img src="{{ asset('assets/images/creed-shodo.png') }}" alt="TeLpp Creed Calligraphy" class="h-24 md:h-32 w-auto invert opacity-100 drop-shadow-md">
                    <p class="text-sm md:text-lg font-bold text-slate-700 leading-relaxed max-w-2xl font-['Shippori_Mincho_B1'] opacity-80 italic">
                        "{{ $profile?->creed_statement ?? 'To achieve sustainable growth in harmony with all stakeholders.' }}"
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 border-t border-slate-200">
                @foreach($creeds as $creed)
                <div class="p-12 border-b md:border-b-0 md:border-r last:border-r-0 border-slate-200 group hover:bg-white transition-colors duration-500">
                    <div class="space-y-10">
                        @php
                            $icon = match($creed->title_en) {
                                'Fairness' => 'balance',
                                'Innovation' => 'flare',
                                'Harmony' => 'spa',
                                default => 'star'
                            };
                        @endphp
                        <span class="material-symbols-outlined text-4xl text-primary">{{ $icon }}</span>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h4 class="text-2xl font-black text-slate-950 tracking-tight">{{ $creed->title_en }}</h4>
                                <span class="text-3xl font-['Shippori_Mincho_B1'] text-slate-200">{{ $creed->title_jp }}</span>
                            </div>
                            @if($creed->tagline)
                            <p class="text-primary font-black text-[10px] uppercase tracking-widest">{{ $creed->tagline }}</p>
                            @endif
                            <p class="text-slate-700 leading-relaxed text-lg font-medium">
                                {{ $creed->description }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    </section>
</div>
