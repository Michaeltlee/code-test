<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function attaching_a_product_to_a_user_requires_an_active_subscription()
    {
        $this->withoutExceptionHandling();

        $this->expectException(\Exception::class);

        $product = Product::factory()->create();

        $this->actingAs(User::factory()->create(['has_active_subscription' => false]))
             ->postJson(route('user.product.add', $product));
    }

    /** @test */
    public function can_attach_a_product_to_a_user()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $product = Product::factory()->create();

        $response = $this->actingAs($user)->postJson(route('user.product.add', $product));

        $response->assertStatus(200);

        // The product is now attached to the user.
        $this->assertCount(1, $user->fresh()->products()->get());
    }

    /** @test */
    public function can_remove_a_product_for_user()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $product = Product::factory()->create();

        $user->products()->attach($product->id);

        $response = $this->actingAs($user)
                         ->deleteJson(route('user.product.remove', $product));

        $response->assertStatus(200);

        // The product is no longer attached to the user.
        $this->assertCount(0, $user->fresh()->products()->get());
    }

    /** @test */
    public function can_list_a_users_products()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        Product::factory()->count(5)->create();

        $user->products()->attach([1, 2, 3]);

        $response = $this->actingAs($user)->getJson(route('user.product.index'));

        $this->assertCount(3, $response->json('products'));
    }
}
