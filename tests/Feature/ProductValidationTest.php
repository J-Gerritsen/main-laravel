<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_creation_fails_without_name()
    {
        Storage::fake('public');

        $adminRole = Role::create(['name' => 'Admin']);

        $user = User::factory()->create([
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($user);

        $response = $this->post(route('products.store'), [
            // 'name' => empty
            'price' => 100,
            'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors(['name']);

        $this->assertDatabaseCount('products', 0);
    }
}
