@extends('layouts.admin')

@section('title', 'Product Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-900">World-Class Products</h2>
            <p class="text-slate-500 font-medium">Manage the catalog of environmental friendly market pulp.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
            <span class="material-symbols-outlined">add</span>
            Add Product
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden group">
            <div class="h-48 bg-slate-100 relative">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                        <span class="material-symbols-outlined text-5xl">image</span>
                    </div>
                @endif
                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="size-12 rounded-2xl bg-white text-slate-900 flex items-center justify-center hover:bg-primary hover:text-white transition-all shadow-xl">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-start">
                    <h3 class="font-black text-slate-900">{{ $product->name }}</h3>
                    @if($product->is_featured)
                        <span class="material-symbols-outlined text-amber-500 text-lg">star</span>
                    @endif
                </div>
                <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">{{ $product->description }}</p>
            </div>
        </div>
        @empty
        <div class="col-span-full p-20 text-center bg-white rounded-[2.5rem] border border-slate-100">
            <div class="flex flex-col items-center gap-4">
                <span class="material-symbols-outlined text-6xl text-slate-200">inventory_2</span>
                <p class="text-slate-400 font-medium">No products listed. Add your first market pulp product.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
