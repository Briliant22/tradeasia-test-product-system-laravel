<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $lang = $this->validateLang($request);

        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Products not yet available'], 200);
        }

        return response()->json([
            'data' => $products->map(fn($product) => $this->transform($product, $lang)),
        ]);
    }

    public function show($id, Request $request)
    {
        $lang = $this->validateLang($request);

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'error' => "Product with ID {$id} does not exist"
            ], 404);
        }

        return response()->json([
            'data' => $this->transform($product, $lang),
        ]);
    }

    private function validateLang(Request $request)
    {
        $lang = $request->query('lang', 'en');

        if (!in_array($lang, ['en', 'id'])) {
            abort(response()->json(['error' => 'Invalid language'], 400));
        }

        return $lang;
    }

    private function transform(Product $product, $lang)
    {
        return [
            'name' => e($product->name[$lang] ?? ''),
            'hs_code' => e($product->hs_code ?? ''),
            'cas_number' => e($product->cas_number ?? ''),
            'image_url' => isset($product->image) && $product->image ? asset('storage/' . $product->image) : null,
            'description' => e($product->description[$lang] ?? ''),
            'application' => e($product->application[$lang] ?? ''),
            'meta' => [
                'meta_title' => e($product->meta_title[$lang] ?? ''),
                'meta_keyword' => e($product->meta_keyword[$lang] ?? ''),
                'meta_description' => e($product->meta_description[$lang] ?? ''),
            ],
        ];
    }
}
