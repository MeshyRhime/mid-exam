@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-boxes mr-3 text-darker-blue bounce-icon"></i> Products List
    </h1>
    <a href="{{ route('products.create') }}" class="btn-primary flex items-center">
        <i class="fas fa-plus-circle mr-2"></i> Add New Product
    </a>
</div>

{{-- Filters Section --}}
<div class="card p-6 mb-6 animate-fade-in">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-filter mr-2 text-darker-blue"></i> Filters
    </h2>
    <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Filter by Category:</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search by Name/Description:</label>
            <input type="text" name="search" id="search" class="form-input" value="{{ request('search') }}" placeholder="Search products...">
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn-primary flex items-center mr-2">
                <i class="fas fa-search mr-2"></i> Apply Filters
            </button>
            <a href="{{ route('products.index') }}" class="btn-secondary flex items-center">
                <i class="fas fa-undo mr-2"></i> Reset
            </a>
        </div>
    </form>
</div>


<div class="card p-6 animate-slide-in-right">
    @if($products->isEmpty())
        <p class="text-center text-gray-600">No products found matching your criteria.</p>
    @else
        <table class="table-auto">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            @if($product->stock <= 5)
                                <span class="text-red-600 font-semibold flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Low Stock ({{ $product->stock }})
                                </span>
                            @else
                                {{ $product->stock }}
                            @endif
                        </td>
                        <td class="flex justify-center space-x-2">
                            <a href="{{ route('products.show', $product->id) }}" class="text-darker-blue hover:text-baby-blue transition-colors duration-200">
                                <i class="fas fa-eye bounce-icon"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-green-500 hover:text-green-700 transition-colors duration-200">
                                <i class="fas fa-edit bounce-icon"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                    <i class="fas fa-trash-alt bounce-icon"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection