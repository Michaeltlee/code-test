<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductImageControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_an_image_to_a_product()
    {
        Storage::fake('product-images');

        $image = UploadedFile::fake()->image('product-image.jpg');
        $product = Product::factory()->create();

        $response = $this->actingAs(User::factory()->create())->putJson(route('product.image.update', $product), [
            'image' => $image,
        ]);

        $response->assertStatus(200);

        $this->assertNotNull($product->fresh()->image);

        Storage::disk('product-images')->assertExists($product->fresh()->image);
    }
}
