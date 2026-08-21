@extends('layouts.admin')
@section('title', 'Manage Products')
@section('header_title', 'Products')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <h2 class="text-lg font-serif text-brand-green">All Products</h2>
        <a href="{{ route('products.create') }}" class="bg-brand-green text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-90 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50/50 text-gray-700 uppercase font-medium">
                <tr>
                    <th scope="col" class="px-6 py-4">Product Name</th>
                    <th scope="col" class="px-6 py-4">Price</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr class="border-t border-gray-100 hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 flex items-center gap-3">
                        @if($product->image_path)
                            <div class="w-12 h-12 rounded-lg overflow-hidden shrink-0 border border-gray-200">
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center shrink-0 text-gray-400">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @endif
                        <div>
                            <span class="font-medium text-gray-900 block">{{ $product->name }}</span>
                            <span class="text-xs text-gray-500">{{ $product->category ? $product->category->name : 'Uncategorized' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($product->is_active)
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-green-200 dark:text-green-900">Active</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex justify-end gap-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="p-2 text-brand-green hover:bg-brand-green/10 rounded transition">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded transition">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                        No products available yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $products->links() }}
    </div>
</div>
@endsection
