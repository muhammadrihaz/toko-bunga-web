<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\FlowerType;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $flowerTypes = FlowerType::all();
        return view('admin.products.create', compact('categories', 'flowerTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'flower_type_id' => 'nullable|exists:flower_types,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'care_instructions' => 'nullable|string',
            'delivery_info' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $data['slug'] = \Str::slug($data['name']) . '-' . time();
        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        
        unset($data['image']);
        
        $product = Product::create($data);
        
        if ($request->hasFile('product_gallery')) {
            foreach ($request->file('product_gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $flowerTypes = FlowerType::all();
        return view('admin.products.edit', compact('product', 'categories', 'flowerTypes'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'flower_type_id' => 'nullable|exists:flower_types,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'care_instructions' => 'nullable|string',
            'delivery_info' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $data['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            if ($product->image_path && \Storage::disk('public')->exists($product->image_path)) {
                \Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        
        unset($data['image']);
        
        $product->update($data);
        
        if ($request->hasFile('product_gallery')) {
            foreach ($request->file('product_gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path && \Storage::disk('public')->exists($product->image_path)) {
            \Storage::disk('public')->delete($product->image_path);
        }
        foreach ($product->images as $img) {
             if (\Storage::disk('public')->exists($img->image_path)) {
                 \Storage::disk('public')->delete($img->image_path);
             }
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    
    public function destroyImage($imageId)
    {
        $image = \App\Models\ProductImage::findOrFail($imageId);
        if (\Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
        return response()->json(['success' => true, 'message' => 'Gallery image deleted.']);
    }
}
