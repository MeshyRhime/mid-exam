<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query()->with('product');

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date . ' 00:00:00');
        }
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        // Filter by product name (through relation)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $sales = $query->orderByDesc('created_at')->get();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get(); // Only sell products that are in stock
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        if (!$product || $product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock for this product. Available: ' . ($product ? $product->stock : 0));
        }

        // Record the sale
        Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'unit_price' => $product->price,
            'total_price' => $product->price * $request->quantity,
        ]);

        // Deduct stock
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully!');
    }

    // We'll keep sales records immutable for simplicity, no edit/delete for sales itself.
    // If you need to "refund" or "cancel" a sale, it would typically be a new transaction type.
}