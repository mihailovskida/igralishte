<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductProductTag;
use App\Models\ProductTag;
use App\Models\Size;
use App\Models\SizeProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $productsQuery = $q ? Product::where('name', 'LIKE', '%' . $q . '%') : Product::query();
        $products = $productsQuery->paginate(10);

        return view('products.index', compact('products', 'q'));
    }

    /**
     * Display a table of the resource.
     */
    public function table(Request $request, Product $product)
    {
        $q = $request->input('q');
        $productsQuery = $q ? Product::where('name', 'LIKE', '%' . $q . '%') : Product::query();
        $products = $productsQuery->paginate(5);
        $colors = ColorProduct::where('product_id', $product->id)->get();
        $sizes = SizeProduct::where('product_id', $product->id)->get();

        return view('products.table', compact('products', 'q', 'colors', 'sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $brands = Brand::where('is_active', true)->get();
        $categories = ProductCategory::all();
        $sizes = Size::all();
        $colors = Color::all();
        $discounts = Discount::all();

        return view('products.create', compact('product', 'categories', 'brands', 'sizes', 'colors', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string|max:500',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:1',
            'size_description'  => 'required|string|max:500',
            'maintenance'       => 'required|string|max:500',
            'brand_id'          => 'required|exists:brands,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'tags'              => 'required|string',
            'tags.*'            => 'string',
            'sizes'             => 'required|array',
            'sizes.*'           => 'string',
            'images'            => 'required|array',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'colors'            => 'required|array',
            'colors.*'          => 'string',
            'discount_id'       => 'exists:discounts,id'
        ]);

        $product = Product::create([
            'name'                  => $request->input('name'),
            'description'           => $request->input('description'),
            'price'                 => $request->input('price'),
            'stock'                 => $request->input('stock'),
            'size_description'      => $request->input('size_description'),
            'maintenance'           => $request->input('maintenance'),
            'brand_id'              => $request->input('brand_id'),
            'product_category_id'   => $request->input('product_category_id'),
            'discount_id'           => $request->input('discount_id'),
        ]);

        // Colors
        $colorNames = $request->input('colors', []);
        $colorIds = Color::whereIn('name', $colorNames)->pluck('id')->toArray();
        $product->colors()->attach($colorIds);

        // Tags
        if ($request->has('tags')) {
            $tags = explode(",", $request->input('tags'));

            foreach ($tags as $tag) {
                $product->tags()->create([
                    'name'  => $tag
                ]);
            }
        }

        // Sizes
        if ($request->has('sizes')) {
            $sizes = $request->input('sizes');

            foreach ($sizes as $size) {
                $sizeModel = Size::firstOrCreate(['name' => $size]);
                $product->sizes()->attach($sizeModel->id);
            }
        }

        // Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('products')->with('success', 'Product created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = ProductCategory::all();
        $sizes = Size::all();
        $colors = Color::all();
        $tags = ProductProductTag::where('product_id', $product->id)->get();
        $discounts = Discount::all();

        return view('products.edit', compact('product', 'brands', 'categories', 'sizes', 'colors', 'tags', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string|max:500',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'size_description'  => 'required|string|max:500',
            'maintenance'       => 'required|string|max:500',
            'brand_id'          => 'required|exists:brands,id',
            'is_active'         =>  'required',
            'product_category_id' => 'required|exists:product_categories,id',
            'tags'              => 'required|string',
            'tags.*'            => 'string',
            'sizes'             => 'required|array',
            'sizes.*'           => 'string',
            'existing_images.*' => 'nullable|exists:images,id',
            'new_images.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'colors'            => 'required|array',
            'colors.*'          => 'string',
            'discount_id'       => 'exists:discounts,id'

        ]);

        $product->update([
            'name'                  => $request->input('name'),
            'description'           => $request->input('description'),
            'price'                 => $request->input('price'),
            'stock'                 => $request->input('stock'),
            'size_description'      => $request->input('size_description'),
            'maintenance'           => $request->input('maintenance'),
            'brand_id'              => $request->input('brand_id'),
            'product_category_id'   => $request->input('product_category_id'),
            'discount_id'           => $request->input('discount_id'),
            'is_active'             => $request->is_active,
        ]);

        // Update colors
        if ($request->has('colors')) {
            $product->colors()->sync($request['colors']);
        } else {
            $product->colors()->detach();
        }

        // Update sizes
        if ($request->has('sizes')) {
            $dbSizes = [];
            foreach ($request->input('sizes', []) as $size) {
                if (!intval($size)) {
                    $dbSize = Size::firstOrCreate(['name' => $size]);
                    $dbSizes[] = $dbSize->id;
                } else {
                    $dbSizes[] = $size;
                }
            }

            $product->sizes()->sync($dbSizes);
        } else {
            $product->sizes()->detach();
        }


        // Update tags
        if ($request->has('tags')) {
            $tags = explode(",", $request->input('tags'));
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = ProductTag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $product->tags()->sync($tagIds);
        }

        // Update existing images
        if ($request->has('existing_images')) {
            foreach ($product->images as $image) {
                if (!in_array($image->id, $request->input('existing_images'))) {
                    $image->delete();
                }
            }
        }

        // Add new images
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images', []) as $image) {
                $path = $image->store('public/images');
                $product->images()->create(['path' => $path]);
            }
        }
        // dd($request);
        return redirect()->route('products')->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->category()->dissociate();
        $product->save();
        $product->tags()->detach();
        $product->images()->delete();

        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully');
    }
}
