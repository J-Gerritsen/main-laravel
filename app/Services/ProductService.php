<?php

namespace App\Services;

use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function all(): Collection
    {
        return Product::all();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function store(ProductStoreRequest $request): Product
    {
        $data = $request->validated();

        return Product::create($data);
    }

    public function update(ProductUpdateRequest $request, Product $product): Product
    {
        $data = $request->validated();

        $product->update($data);

        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
