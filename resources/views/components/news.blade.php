<!-- News Release (Nature Harmony Edition) -->
<section class="py-32 bg-emerald-deep relative overflow-hidden">
    <!-- Atmospheric Depth Glows -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/10 blur-[150px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-1/3 h-1/2 bg-gold-accent/5 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
        <div class="flex flex-col md:flex-row items-end justify-between mb-24 gap-8">
            <div class="max-w-2xl text-left">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-px bg-gold-accent"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold-accent">Strategic Media</span>
                </div>
                <h2 class="text-5xl md:text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white via-white to-gold-accent mb-8 tracking-tighter leading-none">Latest Insights</h2>
                <p class="text-xl text-slate-300 font-medium leading-relaxed">Inside look at our latest reforestation projects, industrial innovations, and community impact.</p>
            </div>
            <a href="#" class="h-14 px-8 border border-white/20 rounded-2xl text-white font-black text-xs uppercase tracking-widest hover:bg-gold-accent hover:text-emerald-deep hover:border-gold-accent transition-all flex items-center gap-3 group shadow-lg">
                Global News Archive 
                <span class="material-symbols-outlined text-sm group-hover:rotate-45 transition-transform">north_east</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @foreach($newsItems as $news)
            <article class="group bg-white/5 backdrop-blur-md rounded-[2.5rem] overflow-hidden border border-white/10 hover:border-gold-accent/40 transition-all duration-700 reveal-hidden shadow-2xl">
                <div class="h-72 overflow-hidden relative">
                    @if($news->thumbnail_path)
                        <img src="{{ asset('storage/' . $news->thumbnail_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $news->title }}">
                    @else
                        <div class="w-full h-full bg-white/5 flex items-center justify-center text-white/5">
                            <span class="material-symbols-outlined text-7xl">image</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-deep/95 via-transparent to-transparent"></div>
                </div>
                <div class="p-10">
                    <div class="flex items-center justify-between mb-8">
                        <span class="px-4 py-1.5 rounded-full bg-gold-accent/15 text-gold-accent text-[10px] font-black uppercase tracking-widest border border-gold-accent/30 shadow-sm">Corporate</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                            {{ $news->published_at ? $news->published_at->format('M d, Y') : '' }}
                        </span>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-6 leading-[1.3] tracking-tight group-hover:text-gold-accent transition-colors line-clamp-2 drop-shadow-sm">
                        {{ $news->title }}
                    </h3>
                    <p class="text-slate-300 mb-10 line-clamp-2 leading-relaxed font-medium">{{ $news->summary }}</p>
                    <a class="inline-flex items-center gap-3 text-gold-accent font-black text-[10px] uppercase tracking-widest group/link" href="#">
                        Full Article 
                        <span class="material-symbols-outlined text-lg group-hover/link:translate-x-2 transition-transform">arrow_right_alt</span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
    <!-- Sharp Elegant separator -->
    <div class="absolute bottom-0 left-0 right-0 h-px bg-white/5"></div>
</section>
