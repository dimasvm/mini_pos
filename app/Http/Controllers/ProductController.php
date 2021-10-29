<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_categories = ProductCategory::all();
        return view('product.create', compact('product_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'product_category_id' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png|max:1024'
        ]);


        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->product_category_id = $request->product_category_id;
        if ($request->hasFile('photo')) {
            $product->photo = $request->photo->store('public');
        }
        $product->save();

        return redirect()->json(['success' => 'Berhasil'])->with(['success', 'Berhasil tambah produk']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_categories = ProductCategory::withTrashed()->get();
        return view('product.edit', compact('product_categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'product_category_id' => 'required|integer',
            'photo' => 'nullable|image|mimes:jpeg,png|max:1024'
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->product_category_id = $request->product_category_id;
        if ($request->hasFile('photo')) {
            Storage::delete($product->photo);
            $product->photo = $request->photo->store('public');
        }
        $product->save();

        return redirect()->route('product.index')->with(['success', 'Berhasil tambah produk']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Berhasil hapus data');
    }

    public function photo_upload(Request $request)
    {
        $path = $request->file->store('public');

        return response()->json(['success' => $path]);
    }
}
