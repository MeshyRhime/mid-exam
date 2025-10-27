@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-cash-register mr-3 text-light-pink bounce-icon"></i> Record New Sale
    </h1>
    <a href="{{ route('sales.index') }}" class="btn-secondary flex items-center">
        <i class="fas fa-arrow-alt-circle-left mr-2"></i> Back to Sales History
    </a>
</div>

<div class="card p-6 animate-slide-in-right">
    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
            <select name="product_id" id="product_id" class="form-select @error('product_id') border-red-500 @enderror" required>
                <option value="">Select a Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} (Stock: {{ $product->stock }}, Price: ${{ number_format($product->price, 2) }})
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
            <input type="number" name="quantity" id="quantity" min="1"
                   class="form-input @error('quantity') border-red-500 @enderror"
                   value="{{ old('quantity', 1) }}" required>
            @error('quantity')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
            <p id="stock-info" class="text-sm text-gray-600 mt-1"></p>
        </div>

        <div class="mb-6">
            <strong class="block text-gray-700 text-sm font-bold mb-2">Estimated Total:</strong>
            <p id="estimated-total" class="text-2xl font-bold text-darker-blue">$0.00</p>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="btn-primary flex items-center">
                <i class="fas fa-receipt mr-2"></i> Complete Sale
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productIdSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const estimatedTotalElement = document.getElementById('estimated-total');
        const stockInfoElement = document.getElementById('stock-info');

        function updateSaleInfo() {
            const selectedOption = productIdSelect.options[productIdSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price || 0);
            const stock = parseInt(selectedOption.dataset.stock || 0);
            const quantity = parseInt(quantityInput.value);

            let total = price * quantity;
            estimatedTotalElement.textContent = '$' + total.toFixed(2);

            if (selectedOption.value) {
                stockInfoElement.textContent = `Available stock: ${stock}`;
                quantityInput.max = stock;

                if (quantity > stock) {
                    stockInfoElement.classList.add('text-red-500');
                    stockInfoElement.classList.remove('text-gray-600');
                } else {
                    stockInfoElement.classList.remove('text-red-500');
                    stockInfoElement.classList.add('text-gray-600');
                }
            } else {
                stockInfoElement.textContent = '';
                quantityInput.max = null;
            }
        }

        productIdSelect.addEventListener('change', updateSaleInfo);
        quantityInput.addEventListener('input', updateSaleInfo);

        // Initial update on page load
        updateSaleInfo();
    });
</script>
@endsection
