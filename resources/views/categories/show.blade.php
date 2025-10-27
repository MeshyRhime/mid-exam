@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-info-circle mr-3 text-darker-blue bounce-icon"></i> Category Details: {{ $category->name }}
    </h1>
    <a href="{{ route('categories.index') }}" class="btn-secondary flex items-center">
        <i class="fas fa-arrow-alt-circle-left mr-2"></i> Back to Categories
    </a>
</div>

<div class="card p-6 animate-slide-in-right">
    <div class="mb-4">
        <strong class="block text-gray-700 text-sm font-bold mb-1">ID:</strong>
        <p>{{ $category->id }}</p>
    </div>
    <div class="mb-4">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Name:</strong>
        <p>{{ $category->name }}</p>
    </div>
    <div class="mb-6">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Description:</strong>
        <p>{{ $category->description ?? 'N/A' }}</p>
    </div>
    <div class="mb-6">
        <strong class="block text-gray-700 text-sm font-bold mb-1">Products in this Category:</strong>
        @if($category->products->isEmpty())
            <p class="text-gray-600 italic">No products in this category.</p>
        @else
            <ul class="list-disc list-inside mt-2">
                @foreach($category->products as $product)
                    <li>
                        <a href="{{ route('products.show', $product->id) }}" class="text-darker-blue hover:underline">
                            {{ $product->name }} ({{ $product->stock }} in stock, ${{ number_format($product->price, 2) }})
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="flex space-x-2">
        <a href="{{ route('categories.edit', $category->id) }}" class="btn-primary flex items-center">
            <i class="fas fa-edit mr-2"></i> Edit
        </a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category and all its products?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger flex items-center">
                <i class="fas fa-trash-alt mr-2"></i> Delete
            </button>
        </form>
    </div>
</div>
@endsection