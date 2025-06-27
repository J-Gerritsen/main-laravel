<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getCart(request()->user());
        return view('cart.index', compact('cartItems'));
    }

    public function add(CartAddRequest $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        $this->cartService->addToCart($request->user(), $product, $quantity);
        return redirect()->route('cart.index');
    }

    public function update(CartUpdateRequest $request, Product $product)
    {
        $quantity = $request->input('quantity');
        $this->cartService->updateQuantity($request->user(), $product, $quantity);
        return redirect()->route('cart.index');
    }

    public function remove(Product $product)
    {
        $this->cartService->removeFromCart(request()->user(), $product);
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        $this->cartService->clearCart(request()->user());
        return redirect()->route('cart.index');
    }
}
