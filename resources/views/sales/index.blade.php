@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-history mr-3 text-darker-blue bounce-icon"></i> Sales History
    </h1>
    <a href="{{ route('sales.create') }}" class="btn-primary flex items-center">
        <i class="fas fa-cash-register mr-2"></i> Record New Sale
    </a>
</div>

{{-- Filters Section for Sales Recorder --}}
<div class="card p-6 mb-6 animate-fade-in">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-filter mr-2 text-darker-blue"></i> Filters
    </h2>
    <form action="{{ route('sales.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-input" value="{{ request('start_date') }}">
        </div>
        <div>
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-input" value="{{ request('end_date') }}">
        </div>
        <div>
            <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search Product:</label>
            <input type="text" name="search" id="search" class="form-input" value="{{ request('search') }}" placeholder="Search by product name...">
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn-primary flex items-center mr-2">
                <i class="fas fa-search mr-2"></i> Apply Filters
            </button>
            <a href="{{ route('sales.index') }}" class="btn-secondary flex items-center">
                <i class="fas fa-undo mr-2"></i> Reset
            </a>
        </div>
    </form>
</div>


<div class="card p-6 animate-slide-in-right">
    @if($sales->isEmpty())
        <p class="text-center text-gray-600">No sales recorded.</p>
    @else
        <table class="table-auto">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Sale Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>
                            <a href="{{ route('products.show', $sale->product->id) }}" class="text-darker-blue hover:underline">
                                {{ $sale->product->name }}
                            </a>
                        </td>
                        <td>{{ $sale->quantity }}</td>
                        <td>${{ number_format($sale->unit_price, 2) }}</td>
                        <td>${{ number_format($sale->total_price, 2) }}</td>
                        <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection