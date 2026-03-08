<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sustainability;
use App\Models\SustainabilityImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SustainabilityController extends Controller
{
    public function index()
    {
        $sustainabilities = Sustainability::orderBy('category')->orderBy('order')->get();
        return view('admin.sustainabilities.index', compact('sustainabilities'));
    }

    public function create()
    {
        return view('admin.sustainabilities.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:50',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:50',
            'order' => 'integer',
            'is_active' => 'nullable|integer',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('sustainability/covers', 'public');
        }

        $sustainability = Sustainability::create($validated);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('sustainability/gallery', 'public');
                SustainabilityImage::create([
                    'sustainability_id' => $sustainability->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.sustainabilities.index')->with('success', 'Sustainability item created successfully.');
    }

    public function edit(Sustainability $sustainability)
    {
        $sustainability->load('images');
        return view('admin.sustainabilities.form', compact('sustainability'));
    }

    public function update(Request $request, Sustainability $sustainability)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:50',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:50',
            'order' => 'integer',
            'is_active' => 'nullable|integer',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            if ($sustainability->cover_image) {
                Storage::disk('public')->delete($sustainability->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('sustainability/covers', 'public');
        }

        $sustainability->update($validated);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('sustainability/gallery', 'public');
                SustainabilityImage::create([
                    'sustainability_id' => $sustainability->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.sustainabilities.index')->with('success', 'Sustainability item updated successfully.');
    }

    public function destroy(Sustainability $sustainability)
    {
        if ($sustainability->cover_image) {
            Storage::disk('public')->delete($sustainability->cover_image);
        }

        foreach ($sustainability->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $sustainability->delete();

        return redirect()->route('admin.sustainabilities.index')->with('success', 'Sustainability item deleted successfully.');
    }

    public function deleteImage(SustainabilityImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image removed from gallery.');
    }

    // Public Show Method
    public function show($slug)
    {
        $menus = \App\Models\Menu::with('allChildren')->whereNull('parent_id')->where('is_actived', 1)->orderBy('id', 'asc')->get();
        $profile = \App\Models\CompanyProfile::first();
        $point = Sustainability::with('images')->where('slug', $slug)->where('is_active', 1)->firstOrFail();
        
        return view('sustainability.show', compact('point', 'menus', 'profile'));
    }
}
