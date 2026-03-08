<!-- Product Highlights -->
<section class="py-32 bg-stone-light relative overflow-hidden">
    <!-- Subtle Nature Glow -->
    <div class="absolute bottom-0 left-0 w-1/4 h-1/2 bg-primary/5 blur-[80px] rounded-full pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
            <div class="max-w-2xl text-left">
                <h2 class="text-4xl font-black text-forest-dark mb-4 tracking-tight drop-shadow-sm">Our Premium Products</h2>
                <p class="text-lg text-slate-700 font-semibold">Exceptional quality crafted with precision, designed for those who value both performance and the planet.</p>
            </div>
            <button class="px-8 py-3 bg-primary/10 text-primary font-black rounded-xl flex items-center gap-2 hover:bg-primary hover:text-white transition-all group shadow-sm">
                Full Catalog 
                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
            @foreach($products as $product)
            <div class="group cursor-pointer reveal-hidden">
                <div class="aspect-[4/5] rounded-[2.5rem] overflow-hidden bg-slate-100 mb-8 relative glass-glow shadow-md group-hover:shadow-2xl group-hover:shadow-primary/25 transition-all duration-700">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $product->name }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                            <span class="material-symbols-outlined text-6xl">potted_plant</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute top-6 right-6 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                        <div class="bg-primary/90 backdrop-blur-md border border-white/20 text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-lg">
                            Premium Grade
                        </div>
                    </div>
                </div>
                <div class="px-2">
                    <h4 class="font-black text-2xl text-slate-950 mb-3 group-hover:text-primary transition-colors tracking-tight drop-shadow-sm">{{ $product->name }}</h4>
                    <p class="text-slate-600 leading-relaxed line-clamp-2 font-bold">{{ $product->description }}</p>
                    <div class="mt-6 flex items-center gap-2 text-primary text-xs font-black uppercase tracking-[0.2em] opacity-0 group-hover:opacity-100 -translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                        View Specs <span class="material-symbols-outlined text-sm">arrow_right_alt</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
