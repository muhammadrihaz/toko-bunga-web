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
        $categories = Category::take(8)->get();
        $products = Product::with('category')->where('is_active', true)->latest()->take(5)->get();
        $galleries = Gallery::latest()->take(5)->get();
        
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session(['captcha_answer' => $num1 + $num2]);
        
        return view('index', compact('categories', 'products', 'galleries', 'num1', 'num2'));
    }

    public function catalogue(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category')->where('is_active', true);
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->latest()->paginate(12)->withQueryString();
        
        return view('catalogue', compact('categories', 'products'));
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
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        session(['captcha_answer' => $num1 + $num2]);
        
        return view('contact', compact('settings', 'num1', 'num2'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'captcha' => 'required|numeric'
        ]);

        if ($request->captcha != session('captcha_answer')) {
            return redirect()->back()->withErrors(['captcha' => 'Jawaban Captcha tidak tepat. Silakan coba lagi.'])->withInput();
        }

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil terkirim!');
    }
}
