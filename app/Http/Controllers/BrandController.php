<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandBrandTag;
use App\Models\BrandCategory;
use App\Models\BrandTag;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();

        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BrandCategory::all();

        return view('brands.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'tags'              => 'required|string',
            'images'            => 'required|array',
            'images.*'          => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories'        => 'required|array',
            'categories.*'      => 'exists:brand_categories,id',
        ]);

        $brand = Brand::create([
            'name'        => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($request->has('tags')) {
            $tags = explode(",", $request->input('tags'));

            foreach ($tags as $tag) {
                $brand->tags()->create([
                    'name'  => $tag
                ]);
            }
        }

        $brand->categories()->attach($request->input('categories', []));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $brand->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('brands')->with('success', 'Brand created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Brand $brand)
    {
        $image_count = $brand->images->count();
        $categories = BrandCategory::all();
        $tags = BrandBrandTag::where('brand_id', $brand->id)->get();
        $brand_categories = $brand->categories()->pluck('brand_categories.id')->toArray();

        return view('brands.edit', compact('brand', 'categories', 'tags', 'brand_categories', 'image_count'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'is_active'         => 'required',
            'tags'              => 'required|string',
            'categories'        => 'required|array',
            'categories.*'      => 'exists:brand_categories,id',
            'existing_images.*' => 'nullable|exists:images,id',
            'new_images.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand->update([
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active,
        ]);

        if ($request->input('tags')) {
            $tagNames = explode(',', $request->tags);

            foreach ($brand->tags as $tag) {
                if (!in_array($tag->name, $tagNames)) {
                    if (!$tag->brands->count()) {
                        $tag->delete();
                    } else {
                        $brand->tags()->detach($tag);
                    }
                }
            }

            foreach ($tagNames as $key => $value) {
                $brandTags = $brand->tags()->pluck('name')->toArray();

                if (!in_array($value, $brandTags)) {
                    $value = trim($value);

                    $dbTag = BrandTag::where('name', $value)->first();

                    if ($dbTag) {
                        $brand->tags()->attach($dbTag);
                    } else {
                        $brand->tags()->create([
                            'name' => $value
                        ]);
                    }
                }
            }
        }

        $brand->categories()->sync($request->categories);

        // Update old images
        if ($request->has('existing_images')) {
            foreach ($brand->images as $image) {
                if (!in_array($image->id, $request->input('existing_images'))) {
                    $image->delete();
                }
            }
        } else {
            $brand->images()->delete();
        }

        // Add new images
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images', []) as $image) {
                $path = $image->store('public/images');
                $brand->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('brands', $brand)->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->categories()->detach();
        $brand->tags()->detach();

        $brand->categories()->delete();
        $brand->tags()->delete();
        $brand->images()->delete();
        $brand->products()->delete();

        $brand->delete();

        return redirect()->route('brands')->with('success', 'Brand deleted successfully');
    }
}
