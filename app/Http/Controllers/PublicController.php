<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Message;

class PublicController extends Controller
{
    public function index()
    {
        $flowerTypes = \App\Models\FlowerType::take(8)->get();
        $products = Product::with('category')->where('is_active', true)->latest()->take(5)->get();
        $galleries = Gallery::latest()->take(5)->get();
        
        return view('index', compact('flowerTypes', 'products', 'galleries'));
    }

    public function catalogue(Request $request)
    {
        $categories = Category::all();
        $flowerTypes = \App\Models\FlowerType::all();
        $query = Product::with('category')->where('is_active', true);
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('flower_type')) {
            $query->where('flower_type_id', $request->flower_type);
        }
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->latest()->paginate(12)->withQueryString();
        
        return view('catalogue', compact('categories', 'flowerTypes', 'products'));
    }
    
    public function productDetail(Request $request)
    {
        if (!$request->id) {
            return redirect('/catalogue');
        }
        
        $product = Product::with('images', 'category')->findOrFail($request->id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
            
        return view('product-detail', compact('product', 'relatedProducts'));
    }

    public function gallery()
    {
        $galleries = \App\Models\Gallery::orderBy('sort_order')->get();
        return view('gallery', compact('galleries'));
    }

    public function about()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('about', compact('settings'));
    }
    
    public function contact()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('contact', compact('settings'));
    }

    public function sendMessage(Request $request)
    {
        return redirect()->back()->with('error', 'Fitur pesan dinonaktifkan.');
    }
}
