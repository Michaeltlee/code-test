<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cannot_create_a_product_if_not_authenticated()
    {
        $this->withoutExceptionHandling();

        $this->expectException(\Illuminate\Auth\AuthenticationException::class);

        $this->postJson(route('api.product.create'), [
            'name'        => 'first product',
            'description' => 'Description of the first product',
            'price'       => 2000,
        ]);
    }

    /** @test */
    public function can_create_a_product()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs(User::factory()->create())->postJson(route('api.product.create'), [
            'name'        => 'first product',
            'description' => 'Description of the first product',
            'price'       => 2000,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', 1);
    }

    /** @test */
    public function can_create_a_product_with_an_image()
    {
        Storage::fake('product-images');
        $this->withoutExceptionHandling();

        $response = $this->actingAs(User::factory()->create())->postJson(route('api.product.create'), [
            'name'        => 'first product',
            'description' => 'Description of the first product',
            'price'       => 2000,
            'image'       => UploadedFile::fake()->image('product-image.jpg'),
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', 1);

        Storage::disk('product-images')->assertExists(Product::find($response->json(['product_id']))->image);
    }

    /** @test */
    public function can_update_a_product()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()->create([
            'price' => 2000,
        ]);

        $response = $this->actingAs(User::factory()->create())->putJson(route('api.product.update', $product), [
            'name'        => 'NEW: first product',
            'description' => 'Description of the NEW first product',
            'price'       => 3000,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', [
            'name'        => 'NEW: first product',
            'description' => 'Description of the NEW first product',
            'price'       => 3000,
        ]);
    }

    /** @test */
    public function can_update_a_product_with_an_image()
    {
        Storage::fake('product-images');
        $this->withoutExceptionHandling();

        $product = Product::factory()->create([
            'price' => 2000,
        ]);

        $image = UploadedFile::fake()->image('product-image.jpg');

        $response = $this->actingAs(User::factory()->create())->putJson(route('api.product.update', $product), [
            'name'        => 'NEW: first product',
            'description' => 'Description of the NEW first product',
            'price'       => 3000,
            'image'       => $image,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', [
            'name'        => 'NEW: first product',
            'description' => 'Description of the NEW first product',
            'price'       => 3000,
        ]);

        Storage::disk('product-images')->assertExists($product->fresh()->image);
    }

    /** @test */
    public function can_delete_a_product()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()->create([
            'price' => 2000,
        ]);

        $response = $this->actingAs(User::factory()->create())->deleteJson(route('api.product.delete', $product));

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', 0);
    }

    /** @test */
    public function can_get_a_product()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()->create([
            'price' => 2000,
        ]);

        $response = $this->actingAs(User::factory()->create())->getJson(route('api.product.show', $product));

        $response->assertStatus(200)->assertJson([
            'name'        => $product->name,
            'description' => $product->description,
            'price'       => $product->price,
            'image'       => $product->image,
        ]);
    }

    /** @test */
    public function can_list_all_products()
    {
        $this->withoutExceptionHandling();

        Product::factory()->count(5)->create();

        $response = $this->actingAs(User::factory()->create())->getJson(route('api.product.index'));

        $response->assertStatus(200);
    }
}
