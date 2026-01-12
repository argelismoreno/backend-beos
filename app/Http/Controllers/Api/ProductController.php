<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $products = Product::with(['currency', 'prices.currency'])->paginate(10);
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request): ProductResource
    {
        DB::beginTransaction();

        try {
            $product = Product::create($request->validated());
            DB::commit();
            return new ProductResource($product->load('currency'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product->load(['currency', 'prices.currency']));
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        DB::beginTransaction();

        try {
            $product->update($request->validated());
            DB::commit();
            return new ProductResource($product->load('currency'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function destroy(Product $product): Response
    {
        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();
            return response()->noContent();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
