<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('products.*', 'brands.name as brand_name', 'categories.name as category_name')
                       ->join('brands', 'brands.id', '=', 'products.brand_id')
                       ->join('categories', 'categories.id', '=', 'products.category_id')
                       ->orderBy('products.id')
                       ->simplePaginate(5);

        return view('admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $one_product = Product::select('products.*', 'brands.name as brand_name', 'categories.name as category_name')
                       ->join('brands', 'brands.id', '=', 'products.brand_id')
                       ->join('categories', 'categories.id', '=', 'products.category_id')
                       ->where('products.id', $product->id)
                       ->first();

        return view('admin.show', compact('one_product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::orderBy('id')->get();
        $categories = Category::orderBy('id')->get();

        return view('admin.edit', compact('product', 'brands', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');

        $attributes = $request->input('attributes', []);
        foreach ($attributes as $key => &$value) {
            // Only decode if the value is a JSON string (array/dictionary format)
            if (is_string($value) && (str_starts_with($value, '{') || str_starts_with($value, '['))) {
                $decodedValue = json_decode($value, true);
                // Check if decoding was successful, else retain original string
                $value = json_last_error() === JSON_ERROR_NONE ? $decodedValue : $value;
            }
        }

        // Assign the processed attributes back to the product
        $product->attributes = $attributes;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product has been deleted');
    }
}
