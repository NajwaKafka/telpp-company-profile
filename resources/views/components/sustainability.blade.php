<!-- Sustainability Section (Dynamic Categorized Gallery) -->
<section id="sustainability" class="py-32 bg-slate-50/50 relative overflow-hidden">
    <!-- Sophisticated Abstract BG -->
    <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-primary/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">

        @php
            $groupedByLabels = [
                'forest' => 'Forestry Management',
                'community' => 'Social & Community',
                'environment' => 'Environmental Preservation',
                'governance' => 'Corporate Governance'
            ];
            $categoriesInDb = $sustainabilityPoints->groupBy('category');
        @endphp

        <div class="space-y-32">
            @foreach($categoriesInDb as $category => $points)
            <div class="space-y-12">
                <!-- Category Heading -->
                <div class="flex items-center gap-6">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-900 border-l-4 border-primary pl-6 py-1">
                        {{ $groupedByLabels[$category] ?? ucfirst($category) }}
                    </h3>
                    <div class="flex-1 h-px bg-slate-200"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($points as $point)
                    <div class="group bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-700 flex flex-col h-full pointer-events-auto">
                        <!-- Cover Image with Multi-hint -->
                        <div class="h-64 relative overflow-hidden bg-slate-100 shrink-0">
                            @if($point->cover_image)
                                <img src="{{ asset('storage/' . $point->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $point->title }}">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-opacity"></div>
                            
                            @if($point->images->count() > 0)
                                <div class="absolute top-6 right-6 px-3 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl flex items-center gap-2">
                                    <span class="material-symbols-outlined text-white text-sm">photo_library</span>
                                    <span class="text-[10px] font-black text-white">+{{ $point->images->count() }} Photos</span>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-10 flex flex-col flex-1 relative">
                            <!-- Floating Icon -->
                            <div class="absolute -top-8 left-10 size-16 bg-primary rounded-2xl flex items-center justify-center text-white shadow-xl shadow-primary/30 group-hover:-translate-y-2 transition-transform duration-500">
                                <span class="material-symbols-outlined text-3xl">{{ $point->icon ?? 'spa' }}</span>
                            </div>

                            <div class="mt-8 space-y-4 flex-1">
                                <h4 class="text-2xl font-black text-slate-950 tracking-tight leading-tight group-hover:text-primary transition-colors">
                                    {{ $point->title }}
                                </h4>
                                <p class="text-slate-600 font-medium leading-relaxed line-clamp-4">
                                    {{ $point->description }}
                                </p>
                            </div>

                            <!-- Footer Link (Functional) -->
                            <a href="{{ route('sustainability.show', $point->slug) }}" class="mt-10 pt-8 border-t border-slate-100 flex items-center justify-between group/link cursor-pointer">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover/link:text-primary transition-colors">View Deep Narrative</span>
                                <span class="material-symbols-outlined text-slate-200 group-hover/link:text-primary group-hover/link:translate-x-1 transition-all">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
