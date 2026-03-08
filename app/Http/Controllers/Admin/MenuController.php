<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('allChildren')->whereNull('parent_id')->orderBy('id', 'asc')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::orderBy('name', 'asc')->get();
        return view('admin.menus.form', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'is_actived' => 'nullable|integer',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $validated['is_actived'] = $request->has('is_actived') ? 1 : 0;

        Menu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::where('id', '!=', $menu->id)->orderBy('name', 'asc')->get();
        return view('admin.menus.form', compact('menu', 'parents'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'is_actived' => 'nullable|integer',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $validated['is_actived'] = $request->has('is_actived') ? 1 : 0;

        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully.');
    }
}
