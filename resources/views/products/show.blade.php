@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-info-circle mr-3 text-darker-blue bounce-icon"></i> Product Details: {{ $product->name }}
    </h1>
    <a href="{{ route('products.index') }}" class="btn-secondary flex items-center">
        <i class="fas fa-arrow-alt-circle-left mr-2"></i> Back to Products
    </a>
</div>

<div class="card p-6 animate-slide-in-right">
    <div class="mb-4">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Product ID:</strong>
        <p>{{ $product->id }}</p>
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Name:</strong>
        <p>{{ $product->name }}</p>
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Category:</strong>
        @if($product->category)
            <a href="{{ route('categories.show', $product->category->id) }}" class="text-darker-blue hover:underline">
                {{ $product->category->name }}
            </a>
        @else
            <p class="italic text-gray-500">Uncategorized</p>
        @endif
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Description:</strong>
        <p>{{ $product->description ?? 'N/A' }}</p>
    </div>

    <div class="mb-4">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Price:</strong>
        <p>${{ number_format($product->price, 2) }}</p>
    </div>

    <div class="mb-6">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Stock:</strong>
        @if($product->stock <= 5)
            <span class="text-red-600 font-semibold flex items-center">
                <i class="fas fa-exclamation-triangle mr-1"></i> Low Stock ({{ $product->stock }})
            </span>
        @else
            <p>{{ $product->stock }}</p>
        @endif
    </div>

    <div class="flex space-x-2">
        <a href="{{ route('products.edit', $product->id) }}" class="btn-primary flex items-center">
            <i class="fas fa-edit mr-2"></i> Edit
        </a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger flex items-center">
                <i class="fas fa-trash-alt mr-2"></i> Delete
            </button>
        </form>
    </div>
</div>
@endsection
