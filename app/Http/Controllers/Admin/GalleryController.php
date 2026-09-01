<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order')->paginate(12);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,webm,ogg|max:20480'
        ]);
        
        $path = $request->file('image')->store('gallery', 'public');
        
        Gallery::create([
            'image_path' => $path,
            'title' => $request->title ?? 'New Element',
            'sort_order' => Gallery::count() + 1
        ]);
        
        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        if (\Storage::disk('public')->exists($gallery->image_path)) {
            \Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();
        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
