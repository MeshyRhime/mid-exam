@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-chart-line mr-3 text-darker-blue bounce-icon"></i> Sales Dashboard
    </h1>
    <a href="{{ route('sales.create') }}" class="btn-primary flex items-center">
        <i class="fas fa-cash-register mr-2"></i> Record New Sale
    </a>
</div>

{{-- Date Filters for Analytics --}}
<div class="card p-6 mb-6 animate-fade-in">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-calendar-alt mr-2 text-darker-blue"></i> Filter Sales Data
    </h2>
    <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
            {{-- Use toDateString() for the input value --}}
            <input type="date" name="start_date" id="start_date" class="form-input" value="{{ $startDate->toDateString() }}">
        </div>
        <div>
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
            {{-- Use toDateString() for the input value --}}
            <input type="date" name="end_date" id="end_date" class="form-input" value="{{ $endDate->toDateString() }}">
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn-primary flex items-center mr-2">
                <i class="fas fa-sync-alt mr-2"></i> Update Data
            </button>
        </div>
    </form>
</div>

{{-- Main Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Total Cash Income Card (Overall) --}}
    <div class="card p-6 flex items-center justify-between animate-fade-in" style="background-color: var(--light-pink); color: white;">
        <div>
            <h3 class="text-lg font-semibold">Total Cash Income (All Time)</h3>
            <p class="text-4xl font-bold mt-2">${{ number_format($totalCashIncome, 2) }}</p>
        </div>
        <i class="fas fa-dollar-sign fa-3x text-white opacity-70"></i>
    </div>

    {{-- Period Sales Card --}}
    <div class="card p-6 flex items-center justify-between animate-slide-in-right" style="background-color: var(--darker-blue); color: white;">
        <div>
            <h3 class="text-lg font-semibold">Sales ({{ $startDate->format('M d') }} - {{ $endDate->format('M d') }})</h3>
            <p class="text-4xl font-bold mt-2">${{ number_format($totalSalesPeriod, 2) }}</p>
        </div>
        <i class="fas fa-money-bill-wave fa-3x text-white opacity-70"></i>
    </div>

    {{-- Transactions Card --}}
    <div class="card p-6 flex items-center justify-between animate-slide-in-right" style="background-color: var(--baby-blue); color: white;">
        <div>
            <h3 class="text-lg font-semibold">Transactions ({{ $startDate->format('M d') }} - {{ $endDate->format('M d') }})</h3>
            <p class="text-4xl font-bold mt-2">{{ $numberOfTransactionsPeriod }}</p>
        </div>
        <i class="fas fa-handshake fa-3x text-white opacity-70"></i>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    {{-- Top Selling Products --}}
    <div class="card p-6 animate-fade-in">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
            <i class="fas fa-trophy mr-2 text-light-pink"></i> Top 5 Selling Products (by quantity)
        </h2>
        @if($topSellingProducts->isEmpty())
            <p class="text-gray-600">No sales recorded in this period.</p>
        @else
            <ul class="list-disc list-inside space-y-2">
                @foreach($topSellingProducts as $sale)
                    <li class="flex items-center justify-between py-1 border-b border-gray-100 last:border-b-0">
                        <span>
                            <i class="fas fa-box mr-2 text-baby-blue"></i>
                            <a href="{{ route('products.show', $sale->product->id) }}" class="text-gray-800 hover:text-darker-blue hover:underline">
                                {{ $sale->product->name }}
                            </a>
                        </span>
                        <span class="font-semibold text-gray-700">{{ $sale->total_quantity_sold }} items sold</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Low Stock Products --}}
    <div class="card p-6 animate-slide-in-right">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
            <i class="fas fa-warehouse mr-2 text-darker-blue"></i> Low Stock Alerts
        </h2>
        @if($lowStockProducts->isEmpty())
            <p class="text-green-600 font-semibold">All products are well-stocked!</p>
        @else
            <ul class="list-disc list-inside space-y-2">
                @foreach($lowStockProducts as $product)
                    <li class="flex items-center justify-between py-1 border-b border-gray-100 last:border-b-0 text-red-600">
                        <span>
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <a href="{{ route('products.show', $product->id) }}" class="text-red-600 hover:underline">
                                {{ $product->name }}
                            </a>
                        </span>
                        <span class="font-semibold">{{ $product->stock }} in stock</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection