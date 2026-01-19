<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_product()
    {
        Storage::fake('public');

        $response = $this->post(route('products.store'), [
            'name' => 'Test Product',
            'price' => 100,
            'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseMissing('products', [
            'name' => 'Test Product',
        ]);
    }
}
