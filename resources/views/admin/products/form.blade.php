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
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400">Product Image</label>
                    <div id="image-preview" class="size-full aspect-square rounded-3xl bg-slate-50 border-2 border-dashed border-slate-100 flex items-center justify-center text-slate-300 relative overflow-hidden group">
                        @if(isset($product) && $product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                        @endif
                        <input type="file" name="image" onchange="previewImage(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
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
    function previewImage(input) {
        const container = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Clear container and add image
                container.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <input type="file" name="image" onchange="previewImage(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
