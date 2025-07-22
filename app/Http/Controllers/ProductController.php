<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }

    private function validateData(Request $request)
    {
        $productId = $request->route('product')?->id;

        return $request->validate([
            'name.en' => ['required', 'string', 'max:100', 'unique:products,name->en,' . $productId],
            'name.id' => ['required', 'string', 'max:100', 'unique:products,name->id,' . $productId],
            'hs_code' => ['required', 'string', 'max:100', 'regex:/^\d{4}\.\d{2}\.\d{2}$/', 'unique:products,hs_code,' . $productId],
            'cas_number' => ['required', 'string', 'max:100', 'regex:/^\d{2,7}-\d{2}-\d{1}$/', 'unique:products,cas_number,' . $productId],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description.en' => ['required', 'string', 'max:1000'],
            'description.id' => ['required', 'string', 'max:1000'],
            'application.en' => ['required', 'string', 'max:100'],
            'application.id' => ['required', 'string', 'max:100'],
            'meta_title.en' => ['nullable', 'string', 'max:100', 'unique:products,meta_title->en,' . $productId],
            'meta_title.id' => ['nullable', 'string', 'max:100', 'unique:products,meta_title->id,' . $productId],
            'meta_keyword.en' => ['nullable', 'string', 'max:100', 'unique:products,meta_keyword->en,' . $productId],
            'meta_keyword.id' => ['nullable', 'string', 'max:100', 'unique:products,meta_keyword->id,' . $productId],
            'meta_description.en' => ['nullable', 'string', 'max:1000'],
            'meta_description.id' => ['nullable', 'string', 'max:1000'],
        ]);
    }

}
