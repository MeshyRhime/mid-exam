@extends('layouts.app')

@section('content')
<div class="row fade-in">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0"><i class="fas fa-box me-2"></i>Product Details</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Name:</strong> {{ $product->name }}
                </div>
                <div class="mb-3">
                    <strong>Category:</strong> {{ $product->category->name }}
                </div>
                <div class="mb-3">
                    <strong>Description:</strong> {{ $product->description ?? 'N/A' }}
                </div>
                <div class="mb-3">
                    <strong>Price:</strong> ${{ number_format($product->price, 2) }}
                </div>
                <div class="mb-3">
                    <strong>Stock:</strong> {{ $product->stock }}
                </div>
                <div class="mb-3">
                    <strong>Created At:</strong> {{ $product->created_at->format('M d, Y H:i A') }}
                </div>
                <div class="mb-3">
                    <strong>Last Updated:</strong> {{ $product->updated_at->format('M d, Y H:i A') }}
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back to Products</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i> Edit Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection