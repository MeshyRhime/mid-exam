@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-edit mr-3 text-green-500 bounce-icon"></i> Edit Category
    </h1>
    <a href="{{ route('categories.index') }}" class="btn-secondary flex items-center">
        <i class="fas fa-arrow-alt-circle-left mr-2"></i> Back to Categories
    </a>
</div>

<div class="card p-6 animate-slide-in-right">
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Category Name:</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-input @error('name') border-red-500 @enderror" 
                value="{{ old('name', $category->name) }}" 
                required>
            @error('name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
            <textarea 
                name="description" 
                id="description" 
                rows="3" 
                class="form-textarea @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="btn-primary flex items-center">
                <i class="fas fa-save mr-2"></i> Update Category
            </button>
        </div>
    </form>
</div>
@endsection
