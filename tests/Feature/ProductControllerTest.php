<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_a_product()
    {
        $this->withoutExceptionHandling();

        // TODO: authenticate
        $response = $this->postJson(route('product.create'), [
            'name'        => 'first product',
            'description' => 'Description of the first product',
            'price'       => 2000,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('products', 1);
    }

    /** @test */
    public function can_update_a_product()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()->create([
            'price' => 2000,
        ]);

        // TODO: authenticate
        $response = $this->putJson(route('product.update', $product), [
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
    public function can_delete_a_product()
    {
        $this->withoutExceptionHandling();

        $product = Product::factory()->create([
            'price' => 2000,
        ]);

        // TODO: authenticate
        $response = $this->deleteJson(route('product.delete', $product));

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

        // TODO: authenticate
        $response = $this->getJson(route('product.show', $product));

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

        // TODO: authenticate
        $response = $this->getJson(route('product.index'));

        $response->assertStatus(200);
    }
}
