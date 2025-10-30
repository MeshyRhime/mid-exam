@extends('layouts.app')

@section('content')
<div class="row fade-in">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0"><i class="fas fa-info-circle me-2"></i>Category Details</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Name:</strong> {{ $category->name }}
                </div>
                <div class="mb-3">
                    <strong>Description:</strong> {{ $category->description ?? 'N/A' }}
                </div>
                <div class="mb-3">
                    <strong>Created At:</strong> {{ $category->created_at->format('M d, Y H:i A') }}
                </div>
                <div class="mb-3">
                    <strong>Last Updated:</strong> {{ $category->updated_at->format('M d, Y H:i A') }}
                </div>
                <h4 class="mt-4"><i class="fas fa-boxes me-2"></i>Products in this Category:</h4>
                @if ($category->products->isEmpty())
                    <p class="alert alert-warning">No products found in this category.</p>
                @else
                    <ul class="list-group">
                        @foreach ($category->products as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                <span class="badge bg-secondary rounded-pill">Stock: {{ $product->stock }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back to Categories</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i> Edit Category</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection