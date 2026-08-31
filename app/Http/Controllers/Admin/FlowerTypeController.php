<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlowerType;

class FlowerTypeController extends Controller
{
    public function index()
    {
        $flowerTypes = FlowerType::latest()->paginate(10);
        return view('admin.flower_types.index', compact('flowerTypes'));
    }

    public function create()
    {
        return view('admin.flower_types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('flower_types', 'public');
        }
        unset($data['image']);
        
        FlowerType::create($data);
        return redirect()->route('flower_types.index')->with('success', 'Jenis Bunga created successfully.');
    }

    public function edit(FlowerType $flowerType)
    {
        return view('admin.flower_types.edit', compact('flowerType'));
    }

    public function update(Request $request, FlowerType $flowerType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($flowerType->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($flowerType->image_path);
            }
            $data['image_path'] = $request->file('image')->store('flower_types', 'public');
        }
        unset($data['image']);

        $flowerType->update($data);
        return redirect()->route('flower_types.index')->with('success', 'Jenis Bunga updated successfully.');
    }

    public function destroy(FlowerType $flowerType)
    {
        $flowerType->delete();
        return redirect()->route('flower_types.index')->with('success', 'Jenis Bunga deleted successfully.');
    }
}
