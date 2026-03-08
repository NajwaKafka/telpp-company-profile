<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = \App\Models\CompanyProfile::latest()->get();
        return view('admin.company.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'history_title' => 'required',
            'history_description' => 'required',
            'creed_statement' => 'nullable',
        ]);

        \App\Models\CompanyProfile::create($data);
        return redirect()->route('admin.company.index')->with('success', 'Profile updated successfully.');
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
        $profile = \App\Models\CompanyProfile::findOrFail($id);
        return view('admin.company.form', compact('profile'));
    }

    public function update(Request $request, string $id)
    {
        $profile = \App\Models\CompanyProfile::findOrFail($id);
        $data = $request->validate([
            'history_title' => 'required',
            'history_description' => 'required',
            'creed_statement' => 'nullable',
        ]);

        $profile->update($data);
        return redirect()->route('admin.company.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        \App\Models\CompanyProfile::destroy($id);
        return redirect()->route('admin.company.index')->with('success', 'Profile deleted.');
    }
}
