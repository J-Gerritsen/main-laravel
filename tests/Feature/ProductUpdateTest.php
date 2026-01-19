<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_product()
    {
        Storage::fake('public');

        $adminRole = Role::create(['name' => 'Admin']);

        $admin = User::factory()->create([
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'name' => 'Old Product Name',
            'price' => 50,
            'category_id' => $category->id,
        ]);

        $response = $this->put(route('products.update', $product), [
            'name' => 'Updated Product Name',
            'price' => 100,
            'cover_image' => UploadedFile::fake()->image('new-cover.jpg'),
        ]);

        $response->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'price' => 100,
        ]);
    }
}
