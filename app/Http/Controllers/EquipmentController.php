<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Image;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('category', 'images')->get();

        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('equipment.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'is_public' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $equipment = Equipment::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'is_public' => $request->is_public,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('equipment', 'public');

            Image::create([
                'equipment_id' => $equipment->id,
                'path' => $path,
            ]);
        }

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment created successfully');
    }

    public function show(Equipment $equipment)
    {
        $equipment->load('category', 'images');

        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $categories = Category::all();

        return view('equipment.edit', compact('equipment', 'categories'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'is_public' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $equipment->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'is_public' => $request->is_public,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('equipment', 'public');

            Image::create([
                'equipment_id' => $equipment->id,
                'path' => $path,
            ]);
        }

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment updated successfully');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipment.index')
            ->with('success', 'Equipment deleted successfully');
    }
    public function search(Request $request)
    {
        $search = $request->search;

        $equipment = Equipment::where('name', 'like', "%{$search}%")
            ->with('category')
            ->get();

        return response()->json($equipment);
    }
}