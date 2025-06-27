<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCart(User $user): Collection
    {
        return $user->cart()->withPivot('quantity')->get();
    }

    public function addToCart(User $user, Product $product, int $quantity = 1): void
    {
        $existing = $user->cart()->where('product_id', $product->getkey())->first();

        if ($existing) {
            $user->cart()->updateExistingPivot($product->getkey(), [
                'quantity' => DB::raw('quantity + ' . $quantity),
            ]);
        } else {
            $user->cart()->attach($product->getkey(), ['quantity' => $quantity]);
        }
    }

    public function updateQuantity(User $user, Product $product, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->removeFromCart($user, $product);
        } else {
            $user->cart()->updateExistingPivot($product->getkey(), ['quantity' => $quantity]);
        }
    }

    public function removeFromCart(User $user, Product $product): void
    {
        $user->cart()->detach($product->getkey());
    }

    public function clearCart(User $user): void
    {
        $user->cart()->detach();
    }
}
