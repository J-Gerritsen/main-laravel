<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Contracts\View\Factory;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->store($request);
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->productService->update($request, $product);
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);
        return redirect()->route('products.index');
    }

    public function byCategory(): object
    {
        $categories = $this->productService->getProductsGroupedByCategory();
        return view('products.store', compact('categories'));
    }

    public function show($id): object
    {
        $product = $this->productService->findCategory($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('products.show', compact('product'));
    }

}
