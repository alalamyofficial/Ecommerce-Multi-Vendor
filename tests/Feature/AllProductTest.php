<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AllProductTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_products()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/all/products/');
        $response->assertStatus(200);
    }
}
