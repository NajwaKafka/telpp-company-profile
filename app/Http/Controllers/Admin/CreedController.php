<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creeds = \App\Models\Creed::orderBy('order')->get();
        return view('admin.creeds.index', compact('creeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.creeds.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_jp' => 'required',
            'title_en' => 'required',
            'tagline' => 'nullable',
            'description' => 'required',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        \App\Models\Creed::create($data);
        return redirect()->route('admin.creeds.index')->with('success', 'Creed created.');
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
        $creed = \App\Models\Creed::findOrFail($id);
        return view('admin.creeds.form', compact('creed'));
    }

    public function update(Request $request, string $id)
    {
        $creed = \App\Models\Creed::findOrFail($id);
        $data = $request->validate([
            'title_jp' => 'required',
            'title_en' => 'required',
            'tagline' => 'nullable',
            'description' => 'required',
            'order' => 'integer',
            'is_active' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

        $creed->update($data);
        return redirect()->route('admin.creeds.index')->with('success', 'Creed updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\Creed::destroy($id);
        return redirect()->route('admin.creeds.index')->with('success', 'Creed deleted.');
    }
}
