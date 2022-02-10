<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct($slug)
    {
        $product = Product::with('photos', 'categories', 'attributesValue.attributeGroup', 'brand')->where('slug', $slug)->first();

        $relatedProducts = Product::with('categories')->whereHas('categories', function ($q) use ($product) {
            $q->whereIn('categories.id', $product->categories->pluck('id'));
        })->get();
        return view('frontend.product.index', compact(['product','relatedProducts']));
    }

    public function getProductByCategory($id) {
        $category = Category::findOrFail($id);
        return view('frontend.product.categoryProducts', compact(['category']));
    }

    public function getProductByCategoryApi($id)
    {
        $products = Product::with('photos','categories')
            ->whereHas('categories', function($q) use($id) {
                $q->where('categories.id', $id);
            })->paginate(12);
        $response = [
            'products' => $products
            ];
        return response()->json($response, 200);
    }

    public function getProductByCategorySortApi($id, $sortMethod)
    {
        $products = Product::with('photos','categories')
            ->whereHas('categories', function($q) use($id) {
                $q->where('categories.id', $id);
            })
            ->orderBy('price', $sortMethod)
            ->paginate(12);
        $response = [
            'products' => $products
        ];
        return response()->json($response, 200);
    }
}
