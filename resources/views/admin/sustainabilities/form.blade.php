@extends('layouts.admin')

@section('title', isset($sustainability) ? 'Edit Initiative' : 'New Initiative')

@section('content')
<div class="max-w-5xl mx-auto">
    <form action="{{ isset($sustainability) ? route('admin.sustainabilities.update', $sustainability->id) : route('admin.sustainabilities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        @if(isset($sustainability)) @method('PUT') @endif

        <div class="bg-white border border-slate-200 rounded-[3rem] shadow-2xl shadow-slate-200/50 overflow-hidden">
            <div class="p-12 border-b border-slate-100 bg-slate-50/30">
                <h2 class="text-xs font-black uppercase tracking-[0.4em] text-primary mb-4">Content Creation</h2>
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter">
                    {{ isset($sustainability) ? 'Refine Initiative' : 'New Impact Record' }}
                </h3>
            </div>

            <div class="p-12 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Category -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Initiative Category</label>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-300 group-focus-within:text-primary transition-colors">category</span>
                            <select name="category" class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl pl-16 pr-8 py-5 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none appearance-none">
                                <option value="forest" {{ (old('category', $sustainability->category ?? '') == 'forest') ? 'selected' : '' }}>Forest Management</option>
                                <option value="community" {{ (old('category', $sustainability->category ?? '') == 'community') ? 'selected' : '' }}>Community Social Responsibility</option>
                                <option value="environment" {{ (old('category', $sustainability->category ?? '') == 'environment') ? 'selected' : '' }}>Environmental Preservation</option>
                                <option value="governance" {{ (old('category', $sustainability->category ?? '') == 'governance') ? 'selected' : '' }}>Corporate Governance</option>
                            </select>
                        </div>
                    </div>

                    <!-- Icon -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Material Icon Name</label>
                        <div class="relative group">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-300 group-focus-within:text-primary transition-colors">auto_awesome</span>
                            <input type="text" name="icon" value="{{ old('icon', $sustainability->icon ?? 'spa') }}" 
                                class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl pl-16 pr-8 py-5 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none" 
                                placeholder="e.g. spa, forest, water_drop">
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Initiative Title</label>
                    <div class="relative group">
                        <input type="text" name="title" value="{{ old('title', $sustainability->title ?? '') }}" 
                            class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl px-8 py-5 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none" 
                            placeholder="Headline for this initiative">
                    </div>
                    @error('title') <p class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Detailed Narrative</label>
                    <textarea name="description" rows="5" 
                        class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-medium rounded-3xl px-8 py-5 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none resize-none" 
                        placeholder="Explain the goals and impact of this initiative...">{{ old('description', $sustainability->description ?? '') }}</textarea>
                    @error('description') <p class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-end">
                    <!-- Cover Image -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Primary Cover Photo</label>
                        <div id="cover-preview" class="relative group flex items-center justify-center border-2 border-dashed border-slate-200 rounded-[2rem] p-8 hover:border-primary transition-all overflow-hidden aspect-video bg-slate-50">
                            @if(isset($sustainability) && $sustainability->cover_image)
                                <img src="{{ asset('storage/' . $sustainability->cover_image) }}" class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div class="text-center">
                                    <span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-primary transition-colors">cloud_upload</span>
                                    <p class="text-[10px] font-black text-slate-400 mt-2 uppercase tracking-widest">Upload Cover</p>
                                </div>
                            @endif
                            <input type="file" name="cover_image" onchange="previewCover(this)" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                        </div>
                    </div>

                    <!-- Status & Order -->
                    <div class="space-y-10">
                        <div class="space-y-4">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Display Priority (Order)</label>
                            <input type="number" name="order" value="{{ old('order', $sustainability->order ?? 0) }}" 
                                class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl px-8 py-5 focus:bg-white focus:border-primary transition-all outline-none">
                        </div>

                        <div class="bg-slate-50 border-2 border-slate-100 rounded-2xl p-6 flex items-center justify-between group hover:border-primary/20 transition-all">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">check_circle</span>
                                <p class="text-sm font-black text-slate-900">Publish Content</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $sustainability->is_active ?? 1) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <div class="bg-white border border-slate-200 rounded-[3rem] shadow-2xl shadow-slate-200/50 p-12">
            <h3 class="text-xl font-black text-slate-900 tracking-tight mb-8">Additional Gallery</h3>
            
            <div id="gallery-previews" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @if(isset($sustainability))
                    @foreach($sustainability->images as $img)
                        <div class="relative aspect-square group">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover rounded-2xl shadow-md" alt="Gallery">
                            <div class="absolute inset-0 bg-red-500/80 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                                <a href="{{ route('admin.sustainabilities.delete-image', $img->id) }}" class="text-white hover:scale-125 transition-transform" onclick="return confirm('Remove image?')">
                                    <span class="material-symbols-outlined text-3xl">delete</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
                
                <div class="relative aspect-square border-2 border-dashed border-slate-100 rounded-2xl flex items-center justify-center hover:border-primary transition-all group overflow-hidden bg-slate-50">
                    <input type="file" name="gallery[]" multiple onchange="previewGallery(this)" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-slate-200 group-hover:text-primary/40 transition-colors text-4xl">add_photo_alternate</span>
                        <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest mt-1">Add Photos</p>
                    </div>
                </div>
            </div>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-6 italic">Support multiple JPG/PNG up to 2MB each.</p>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="flex-1 bg-primary text-white py-6 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                {{ isset($sustainability) ? 'Finalize Record' : 'Commit Initiative' }}
            </button>
            <a href="{{ route('admin.sustainabilities.index') }}" class="px-10 py-6 text-slate-500 font-black text-sm uppercase tracking-[0.2em] hover:text-slate-900 transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewCover(input) {
        const container = document.getElementById('cover-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `
                    <img src="${e.target.result}" class="absolute inset-0 w-full h-full object-cover">
                    <input type="file" name="cover_image" onchange="previewCover(this)" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewGallery(input) {
        const container = document.getElementById('gallery-previews');
        
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = "relative aspect-square";
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover rounded-2xl shadow-md">
                        <div class="absolute inset-2 right-auto bottom-auto">
                            <span class="px-2 py-1 rounded-lg bg-primary text-white text-[8px] font-black uppercase tracking-widest shadow-lg italic">New Selection</span>
                        </div>
                    `;
                    // Insert before the last child (the upload button)
                    container.insertBefore(div, container.lastElementChild);
                };
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endpush
