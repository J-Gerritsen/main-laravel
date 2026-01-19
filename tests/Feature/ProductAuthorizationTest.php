<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_create_product()
    {
        Storage::fake('public');

        $userRole = Role::create(['name' => 'User']);

        $user = User::factory()->create([
            'role_id' => $userRole->id,
        ]);

        $this->actingAs($user);

        $response = $this->post(route('products.store'), [
            'name' => 'Test Product',
            'price' => 100,
            'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
        ]);
    }
}
