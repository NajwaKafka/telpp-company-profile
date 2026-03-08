@extends('layouts.admin')

@section('title', 'Company Profile Management')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-900">Corporate Narrative</h2>
            <p class="text-slate-500 font-medium">Manage the history, location, and strategic facts of TeLpp.</p>
        </div>
        <a href="{{ route('admin.company.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
            <span class="material-symbols-outlined">add</span>
            New Profile Version
        </a>
    </div>

    <!-- Stats Grid Removed (Simplified Structure) -->

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">History Title</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Last Updated</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($profiles as $profile)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <p class="font-bold text-slate-900">{{ $profile->history_title }}</p>
                    </td>
                    <td class="px-8 py-6 text-sm text-slate-500 font-medium">
                        {{ $profile->updated_at->format('M d, Y') }}
                    </td>
                    <td class="px-8 py-6 text-right space-x-2">
                        <a href="{{ route('admin.company.edit', $profile->id) }}" class="inline-flex items-center justify-center size-10 rounded-xl bg-slate-100 text-slate-600 hover:bg-primary hover:text-white transition-all">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </a>
                        <form action="{{ route('admin.company.destroy', $profile->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center justify-center size-10 rounded-xl bg-slate-100 text-slate-600 hover:bg-red-500 hover:text-white transition-all">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <span class="material-symbols-outlined text-6xl text-slate-200">database</span>
                            <p class="text-slate-400 font-medium">No company profiles found. Create your first narrative.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
