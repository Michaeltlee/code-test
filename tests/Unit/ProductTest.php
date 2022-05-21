<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function can_create_a_product()
    {
        Product::create([
            'user_id'     => User::factory()->create()->id,
            'name'        => 'First Product',
            'description' => 'This first product',
            'price'       => 20000,
            'image'       => null,
        ]);

        $this->assertDatabaseCount('products', 1);
    }

    /**
     * @test
     *
     * @return void
     */
    public function cannot_create_a_product_without_a_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Product::create([
            'user_id'     => User::factory()->create()->id,
//            'name'        => 'First Product',
            'description' => 'This first product',
            'price'       => 20000,
            'image'       => null,
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function cannot_create_a_product_without_a_description()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Product::create([
            'user_id'     => User::factory()->create()->id,
            'name'        => 'First Product',
//            'description' => 'This first product',
            'price'       => 20000,
            'image'       => null,
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function cannot_create_a_product_without_a_price()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        Product::create([
            'user_id'     => User::factory()->create()->id,
            'name'        => 'First Product',
            'description' => 'This first product',
//            'price'       => 20000,
            'image'       => null,
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function cannot_create_a_product_without_a_user_id()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Product::create([
//            'user_id'     => User::factory()->create()->id,
            'name'        => 'First Product',
            'description' => 'This first product',
            'price'       => 20000,
            'image'       => null,
        ]);
    }
}
