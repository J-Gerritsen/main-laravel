<?php

namespace App\Services;

use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

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

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $this->imageUploadService->uploadSingle(
                $request->file('cover_image'),
                'products/cover_images'
            );
        }

        if ($request->hasFile('images')) {
            $data['images'] = $this->imageUploadService->uploadMultiple(
                $request->file('images'),
                'products/images'
            );
        }

        return Product::create($data);
    }

    public function update(ProductUpdateRequest $request, Product $product): Product
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {

            $data['cover_image'] = $this->imageUploadService->uploadSingle(
                $request->file('cover_image'),
                'products/cover_images'
            );
        }

        if ($request->hasFile('images')) {

            $data['images'] = $this->imageUploadService->uploadMultiple(
                $request->file('images'),
                'products/images'
            );
        }

        $product->update($data);

        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    private function deleteImage(string $path): void
    {
        Storage::disk('public')->delete($path);
    }
}
