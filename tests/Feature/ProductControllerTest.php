<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cannot_create_a_product_if_not_authenticated()
    {
        $this->withoutExceptionHandling();

        $this->expectException(\Illuminate\Auth\AuthenticationException::class);

        $this->postJson(route('product.create'), [
            'name'        => 'first product',
            'description' => 'Description of the first product',
            'price'       => 2000,
        ]);
    }

    /** @test */
    public function can_create_a_product()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs(User::factory()->create())->postJson(route('product.create'), [
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

        $response = $this->actingAs(User::factory()->create())->putJson(route('product.update', $product), [
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

        $response = $this->actingAs(User::factory()->create())->deleteJson(route('product.delete', $product));

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

        $response = $this->actingAs(User::factory()->create())->getJson(route('product.show', $product));

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

        $response = $this->actingAs(User::factory()->create())->getJson(route('product.index'));

        $response->assertStatus(200);
    }
}
