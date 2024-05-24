<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\DiscountCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $q = $request->input('q');

        $categories = DiscountCategory::all();

        if ($q) {
            $discounts = Discount::where('code', 'LIKE', '%' . $q . '%')->get();
        } else {
            $discounts = Discount::all();
        }

        return view('discounts.index', compact('discounts', 'categories', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DiscountCategory::all();
        $products = Product::all();

        return view('discounts.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'code'                  => 'required|string|max:255',
            'amount'                => 'required|numeric',
            'is_active'             => 'required|boolean',
            'discount_category_id'  => 'required|exists:discount_categories,id',
            'products'              => 'required|array',
            'products.*'            => 'exists:products,id',
        ]);

        $discount = Discount::create([
            'code'                  => $request->input('code'),
            'amount'                => $request->input('amount'),
            'is_active'             => $request->input('is_active'),
            'discount_category_id'  => $request->input('discount_category_id'),
        ]);

        foreach ($request->input('products', []) as $productId) {
            $product = Product::findOrFail($productId);
            $product->discount_id = $discount->id;
            $product->save();
        }

        return redirect()->route('discounts')->with('success', 'Discount created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Discount $discount)
    {
        $categories = DiscountCategory::all();
        $products = Product::all();

        $selectedProductIds = $discount->products->pluck('id')->toArray();

        return view('discounts.edit', compact('categories', 'discount', 'products', 'selectedProductIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'code'                  => 'required|string|max:255',
            'amount'                => 'required|string',
            'is_active'             => 'required',
            'discount_category_id'  => 'required|string',
            'products'              => 'array',
            'products.*'            => 'exists:products,id',
        ]);

        if ($discount->is_active == 0 && $request->filled('is_active') && $request->input('is_active') == 1) {
            $discount->update(['is_active' => 1]);
            return redirect()->route('discounts')->with('success', 'Discount is now active.');
        }

        if ($discount->is_active == 0) {
            return redirect()->back()->with('error', 'Cannot edit a discount that is inactive.');
        }
        $discount->update([
            'code'                  => $request->input('code'),
            'amount'                => $request->input('amount'),
            'is_active'             => $request->input('is_active'),
            'discount_category_id'  => $request->input('discount_category_id'),
        ]);


        if ($request->input('is_active') == 0) {
            $discount->products()->update(['discount_id' => null]);
        } else {
            $currentProducts = $discount->products()->pluck('id')->toArray();
            $selectedProducts = $request->input('products', []);

            foreach ($selectedProducts as $productId) {
                if (!in_array($productId, $currentProducts)) {
                    Product::findOrFail($productId)->update(['discount_id' => $discount->id]);
                }
            }

            foreach ($currentProducts as $productId) {
                if (!in_array($productId, $selectedProducts)) {
                    Product::findOrFail($productId)->update(['discount_id' => null]);
                }
            }
        }

        return redirect()->route('discounts')->with('success', 'Discount updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        if ($discount->products->count()) {
            return redirect()->route('discounts')->with('error', 'Discount is used');
        }

        $discount->delete();

        return redirect()->route('discounts')->with('success', 'Discount deleted successfully');
    }
}
