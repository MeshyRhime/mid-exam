@extends('layouts.app')

@section('content')
<div class="row fade-in">
    <div class="col-md-10 offset-md-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-list me-2"></i>Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary animate__animated animate__pulse">
                <i class="fas fa-plus-circle me-1"></i> Add New Category
            </a>
        </div>

        @if ($categories->isEmpty())
            <div class="alert alert-info text-center fade-in" role="alert">
                No categories found. Please add a new one!
            </div>
        @else
            <div class="card fade-in">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info me-1" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection