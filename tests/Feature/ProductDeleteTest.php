<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_product()
    {
        $adminRole = Role::create(['name' => 'Admin']);

        $admin = User::factory()->create([
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'name' => 'Product Name',
            'price' => 50,
            'category_id' => $category->id,
        ]);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
