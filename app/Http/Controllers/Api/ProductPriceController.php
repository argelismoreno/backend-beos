<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductPriceRequest;
use App\Http\Resources\ProductPriceResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ProductPriceController extends Controller
{
    public function index(Product $product): AnonymousResourceCollection
    {
        $prices = $product->prices()->with('currency')->get();
        return ProductPriceResource::collection($prices);
    }

    public function store(StoreProductPriceRequest $request, Product $product): ProductPriceResource
    {
        DB::beginTransaction();

        try {
            $price = $product->prices()->create($request->validated());
            DB::commit();
            return new ProductPriceResource($price->load('currency'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
