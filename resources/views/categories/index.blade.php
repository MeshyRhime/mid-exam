@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-tags mr-3 text-darker-blue bounce-icon"></i> Categories List
    </h1>
    <a href="{{ route('categories.create') }}" class="btn-primary flex items-center">
        <i class="fas fa-plus-circle mr-2"></i> Add New Category
    </a>
</div>

<div class="card p-6 animate-slide-in-right">
    @if($categories->isEmpty())
        <p class="text-center text-gray-600">No categories found. Start by adding one!</p>
    @else
        <table class="table-auto">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?? 'N/A' }}</td>
                        <td class="flex justify-center space-x-2">
                            <a href="{{ route('categories.show', $category->id) }}" class="text-darker-blue hover:text-baby-blue transition-colors duration-200">
                                <i class="fas fa-eye bounce-icon"></i>
                            </a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-green-500 hover:text-green-700 transition-colors duration-200">
                                <i class="fas fa-edit bounce-icon"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category and all its products?');">
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