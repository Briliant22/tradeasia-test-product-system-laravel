<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');
        if (!in_array($lang, ['en', 'id'])) {
            return response()->json(['error' => 'Invalid language'], 400);
        }

        return Product::all()->map(fn($product) => $this->transform($product, $lang));
    }

    public function show($id, Request $request)
    {
        $lang = $request->query('lang', 'en');
        if (!in_array($lang, ['en', 'id'])) {
            return response()->json(['error' => 'Invalid language'], 400);
        }

        $product = Product::findOrFail($id);
        return $this->transform($product, $lang);
    }

    private function transform(Product $product, $lang)
    {
        return [
            'name' => $product->name[$lang] ?? '',
            'hs_code' => $product->hs_code ?? '',
            'cas_number' => $product->cas_number ?? '',
            'image_url' => isset($product->image) && $product->image ? asset('storage/' . $product->image) : null,
            'description' => $product->description[$lang] ?? '',
            'application' => $product->application[$lang] ?? '',
            'meta' => [
                'meta_title' => $product->meta_title[$lang] ?? '',
                'meta_keyword' => $product->meta_keyword[$lang] ?? '',
                'meta_description' => $product->meta_description[$lang] ?? '',
            ],
        ];
    }
}
