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
}
