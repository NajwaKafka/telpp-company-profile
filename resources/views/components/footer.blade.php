<!-- Footer (Nature Harmony Edition) -->
<footer class="bg-[#011a14] text-slate-400 py-32 border-t border-white/5 relative overflow-hidden">
    <!-- Decorative Depth Glow -->
    <div class="absolute top-0 right-0 w-1/3 h-full bg-gold-accent/5 blur-[150px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-20 mb-24">
            <div class="col-span-1 lg:col-span-1">
                <div class="flex items-center gap-4 mb-10">
                    <div class="bg-primary p-3 rounded-2xl shadow-2xl shadow-primary/40 border border-white/10">
                        <span class="material-symbols-outlined text-white text-3xl material-symbols-filled">nest_eco_leaf</span>
                    </div>
                    <span class="text-3xl font-black text-white tracking-tighter drop-shadow-sm">TeLpp.</span>
                </div>
                <p class="mb-10 leading-relaxed font-medium text-lg text-slate-400">
                    Global leaders in high-performance, sustainable pulp solutions. Rooted in North Sumatra, driven by innovation for a resilient future.
                </p>
                <div class="flex gap-5">
                    @foreach(['social_leaderboard', 'hub', 'rss_feed'] as $icon)
                    <a class="size-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-white/40 hover:bg-gold-accent hover:text-emerald-deep hover:border-gold-accent transition-all duration-500" href="#">
                        <span class="material-symbols-outlined text-xl">{{ $icon }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-white font-black uppercase tracking-[0.4em] text-[10px] mb-10 opacity-50">Headquarters</h4>
                <ul class="space-y-8 text-sm font-bold">
                    <li class="flex items-start gap-5 group">
                        <span class="material-symbols-outlined text-gold-accent group-hover:scale-110 transition-transform">location_on</span>
                        <span class="group-hover:text-white transition-colors">Parmaksian, Toba District <br/><span class="font-medium text-slate-500 italic uppercase text-[10px] tracking-widest mt-1 block">North Sumatra, Indonesia</span></span>
                    </li>
                    <li class="flex items-center gap-5 group">
                        <span class="material-symbols-outlined text-gold-accent group-hover:scale-110 transition-transform">call</span>
                        <span class="group-hover:text-white transition-colors">+62 (632) 123-4567</span>
                    </li>
                    <li class="flex items-center gap-5 group">
                        <span class="material-symbols-outlined text-gold-accent group-hover:scale-110 transition-transform">mail</span>
                        <span class="group-hover:text-white transition-colors">corporate@telpp.com</span>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-black uppercase tracking-[0.4em] text-[10px] mb-10 opacity-50">Industrial Strategy</h4>
                <ul class="space-y-4 text-sm font-bold">
                    @foreach(['Circular Economy', 'Sustainability Roadmap', 'Investor Relations', 'Media Assets', 'Privacy Ethics'] as $link)
                    <li><a class="text-slate-500 hover:text-gold-accent transition-all flex items-center gap-2 group" href="#">
                        <span class="w-0 h-px bg-gold-accent group-hover:w-4 transition-all"></span>
                        {{ $link }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-[3rem] overflow-hidden bg-white/5 border border-white/10 relative group h-64 lg:h-auto">
                <img src="https://images.unsplash.com/photo-144837500841da-6b21c64c49f9?q=80&amp;w=2070&amp;auto=format&amp;fit=crop" class="w-full h-full object-cover grayscale opacity-20 group-hover:opacity-60 group-hover:grayscale-0 transition-all duration-1000" alt="Sustainable Forest">
                <div class="absolute inset-0 bg-gradient-to-tr from-[#011a14]/90 to-transparent"></div>
                <div class="absolute bottom-10 left-10 right-10">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gold-accent mb-2 block">Our Concession</span>
                    <p class="text-white font-bold leading-tight text-lg shadow-sm">Preserving Biodiversity in North Sumatra.</p>
                </div>
            </div>
        </div>

        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8 text-[10px] font-black uppercase tracking-[0.3em] text-slate-700">
            <p>© 2024 Toba Pulp Lestari. All rights reserved.</p>
            <div class="flex items-center gap-10">
                <span>FSC Verified</span>
                <span>PEFC Certified</span>
                <span class="text-primary font-black">ISO 14001</span>
            </div>
        </div>
    </div>
</footer>
