@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-edit mr-3 text-green-500 bounce-icon"></i> Edit Product
    </h1>
    <a href="{{ route('products.index') }}" class="btn-secondary flex items-center">
        <i class="fas fa-arrow-alt-circle-left mr-2"></i> Back to Products
    </a>
</div>

<div class="card p-6 animate-slide-in-right">
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') border-red-500 @enderror" required>
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-input @error('name') border-red-500 @enderror" 
                value="{{ old('name', $product->name) }}" 
                required>
            @error('name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
            <textarea 
                name="description" 
                id="description" 
                rows="3" 
                class="form-textarea @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    step="0.01" 
                    min="0" 
                    class="form-input @error('price') border-red-500 @enderror" 
                    value="{{ old('price', $product->price) }}" 
                    required>
                @error('price')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stock:</label>
                <input 
                    type="number" 
                    name="stock" 
                    id="stock" 
                    min="0" 
                    class="form-input @error('stock') border-red-500 @enderror" 
                    value="{{ old('stock', $product->stock) }}" 
                    required>
                @error('stock')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="btn-primary flex items-center">
                <i class="fas fa-save mr-2"></i> Update Product
            </button>
        </div>
    </form>
</div>
@endsection
