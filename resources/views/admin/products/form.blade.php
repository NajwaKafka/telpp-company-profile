@extends('layouts.admin')

@section('title', 'Editor: Market Pulp Product')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-12 flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="size-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="text-3xl font-black text-slate-900">{{ isset($product) ? 'Edit Product' : 'Add New Category' }}</h2>
            <p class="text-slate-500 font-medium">Showcase the quality of TeLpp mill production.</p>
        </div>
    </div>

    <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Product Name</label>
                        <input type="text" name="name" value="{{ $product->name ?? '' }}" placeholder="e.g. Bleached Kraft Pulp" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-black text-slate-900" required>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Product Slug</label>
                        <input type="text" name="slug" value="{{ $product->slug ?? '' }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent text-sm font-bold text-slate-500" placeholder="auto-generated">
                    </div>

                    <div class="flex items-center gap-4 px-2">
                        <input type="checkbox" name="is_featured" value="1" id="is_featured" {{ (isset($product) && $product->is_featured) ? 'checked' : '' }} class="size-6 rounded-lg text-primary focus:ring-primary border-slate-200">
                        <label for="is_featured" class="font-bold text-slate-600">Featured on Homepage</label>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400">Main Product Image</label>
                    <div class="size-full aspect-square rounded-3xl bg-slate-50 border-2 border-dashed border-slate-100 flex items-center justify-center text-slate-300 relative overflow-hidden group">
                        <div id="image-preview" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            @if(isset($product) && $product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                            @endif
                        </div>
                        <input type="file" name="image" onchange="previewMainImage(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="space-y-6 pt-8 border-t border-slate-50">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Product Gallery (Additional Photos)</label>
                
                @if(isset($product) && $product->images->count() > 0)
                    <div class="grid grid-cols-4 gap-4 mb-6">
                        @foreach($product->images as $img)
                            <div class="relative aspect-square rounded-2xl overflow-hidden group border border-slate-100">
                                <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover">
                                <a href="{{ route('admin.products.delete-image', $img->id) }}" 
                                   onclick="return confirm('Delete this image?')"
                                   class="absolute top-2 right-2 size-8 bg-red-500 text-white rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all shadow-lg hover:bg-red-600">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="w-full p-8 rounded-3xl bg-slate-50 border-2 border-dashed border-slate-100 flex flex-col items-center justify-center text-slate-300 relative group overflow-hidden">
                    <span class="material-symbols-outlined text-5xl mb-3 group-hover:scale-110 transition-transform">add_a_photo</span>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Select Multiple Photos</p>
                    <input type="file" name="images[]" multiple class="absolute inset-0 opacity-0 cursor-pointer" onchange="handleGalleryPreviews(this)">
                    <div id="gallery-previews" class="flex flex-wrap gap-3 mt-6 w-full"></div>
                </div>
            </div>

            <div class="space-y-2 pt-6 border-t border-slate-50">
                <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-2">Description & Technical Details</label>
                <textarea name="description" rows="6" placeholder="Highlight the quality and eco-friendliness..." class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-primary transition-all outline-none font-medium text-slate-600">{{ $product->description ?? '' }}</textarea>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-12 py-5 bg-primary text-white rounded-[2.5rem] font-black shadow-xl shadow-primary/20 hover:scale-105 transition-all">
                Save Product
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewMainImage(input) {
        const container = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function handleGalleryPreviews(input) {
        const container = document.getElementById('gallery-previews');
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'size-16 rounded-xl bg-slate-200 overflow-hidden shadow-sm border border-white';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endpush
