<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function can_create_a_user()
    {
        User::factory()->create();

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * @test
     *
     * @return void
     */
    public function user_must_have_a_first_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        User::factory()->create(['first_name' => null]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function user_must_have_a_last_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        User::factory()->create(['last_name' => null]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function user_must_have_an_email()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        User::factory()->create(['email' => null]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function can_check_user_for_an_active_subscription()
    {
        // TODO: create a Subscription model
        // TODO: create a User-Subscription relation
        // Set this as an attribute on the User model for now.
        $user = User::factory()->create(['has_active_subscription' => false]);

        $this->assertFalse($user->canAddProduct());

        $user->update(['has_active_subscription' => true]);
        $this->assertTrue($user->canAddProduct());
    }

    /**
     * @test
     *
     * @return void
     */
    public function user_has_products_relationship()
    {
        $user = User::factory()->create();

        $this->assertCount(0, $user->products->all());
    }
}
