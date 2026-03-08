@extends('layouts.admin')

@section('title', isset($menu) ? 'Edit Menu Item' : 'New Menu Item')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-[3rem] shadow-2xl shadow-slate-200/50 overflow-hidden transition-all duration-700 hover:shadow-primary/5">
        <div class="p-12 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-xs font-black uppercase tracking-[0.4em] text-primary mb-4">Nav Configuration</h2>
            <h3 class="text-4xl font-black text-slate-900 tracking-tighter">
                {{ isset($menu) ? 'Update Navigation' : 'Define New Path' }}
            </h3>
        </div>

        <form action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}" method="POST" class="p-12 space-y-10">
            @csrf
            @if(isset($menu)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Name -->
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Display Name</label>
                    <div class="relative group">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-300 group-focus-within:text-primary transition-colors">label</span>
                        <input type="text" name="name" value="{{ old('name', $menu->name ?? '') }}" 
                            class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl pl-16 pr-8 py-5 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none" 
                            placeholder="e.g. Products">
                    </div>
                    @error('name') <p class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- URL -->
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Destination URL</label>
                    <div class="relative group">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-300 group-focus-within:text-primary transition-colors">link</span>
                        <input type="text" name="url" value="{{ old('url', $menu->url ?? '') }}" 
                            class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl pl-16 pr-8 py-5 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none" 
                            placeholder="/products or https://...">
                    </div>
                    @error('url') <p class="text-red-500 text-[10px] font-bold uppercase ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-end">
                <!-- Parent -->
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Menu Level (Parent)</label>
                    <div class="relative group">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-300 group-focus-within:text-primary transition-colors">account_tree</span>
                        <select name="parent_id" class="w-full bg-slate-50 border-2 border-slate-100 text-slate-900 text-sm font-bold rounded-2xl pl-16 pr-8 py-5 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none appearance-none">
                            <option value="">Primary Menu (No Parent)</option>
                            @foreach($parents as $p)
                                <option value="{{ $p->id }}" {{ (old('parent_id', $menu->parent_id ?? '') == $p->id) ? 'selected' : '' }}>
                                    {{ $p->name }} {{ $p->parent_id ? '(Sub-menu)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Status -->
                <div class="bg-slate-50 border-2 border-slate-100 rounded-2xl p-6 flex items-center justify-between group hover:border-primary/20 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="size-10 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">toggle_on</span>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-900">Active Status</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Visibility on Header</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_actived" value="1" class="sr-only peer" {{ old('is_actived', $menu->is_actived ?? 1) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
            </div>

            <div class="pt-10 flex items-center gap-4">
                <button type="submit" class="flex-1 bg-primary text-white py-6 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                    {{ isset($menu) ? 'Update Navigation' : 'Establish Menu Item' }}
                </button>
                <a href="{{ route('admin.menus.index') }}" class="px-10 py-6 text-slate-500 font-black text-sm uppercase tracking-[0.2em] hover:text-slate-900 transition-colors">
                    Back
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
