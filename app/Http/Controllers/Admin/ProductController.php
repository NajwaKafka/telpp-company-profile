<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = \App\Models\Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'nullable',
            'is_featured' => 'boolean',
            'image' => 'nullable|image',
            'images.*' => 'nullable|image',
        ]);

        $data['slug'] = $data['slug'] ?? \Illuminate\Support\Str::slug($data['name']);
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product = \App\Models\Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = \App\Models\Product::with('images')->findOrFail($id);
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'slug' => 'nullable',
            'is_featured' => 'nullable',
            'image' => 'nullable|image',
            'images.*' => 'nullable|image',
        ]);

        $data['slug'] = $data['slug'] ?? \Illuminate\Support\Str::slug($data['name']);
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\Product::destroy($id);
        return redirect()->route('admin.products.index')->with('success', 'Product removed.');
    }

    public function deleteImage(\App\Models\ProductImage $image)
    {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image);
        $image->delete();
        return back()->with('success', 'Image deleted.');
    }
}
