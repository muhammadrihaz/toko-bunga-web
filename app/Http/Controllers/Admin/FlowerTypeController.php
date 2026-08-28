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
        ]);
        
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
        ]);

        $flowerType->update($data);
        return redirect()->route('flower_types.index')->with('success', 'Jenis Bunga updated successfully.');
    }

    public function destroy(FlowerType $flowerType)
    {
        $flowerType->delete();
        return redirect()->route('flower_types.index')->with('success', 'Jenis Bunga deleted successfully.');
    }
}
