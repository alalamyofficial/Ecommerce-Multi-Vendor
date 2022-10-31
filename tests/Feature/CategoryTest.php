<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_all_categories()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create()->make(['userType'=>false]);
        $response = $this->actingAs($user)->get('/categories');
        $response->assertStatus(200);
    }

    public function test_add_category(){

        $this->withoutExceptionHandling();
        $user = User::factory()->create()->make(['userType'=>false]);

        $response = $this->actingAs($user)
        ->json('POST','store/category',['name' => 'Sally']);
 
        $response
            ->assertStatus(200);

    }

    public function test_delete_category()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create()->make(['userType'=>false]);
        $category = Category::factory()->create();
        $response = $this->actingAs($user)
                    ->get('/delete/category/'.$category->id);
        $response->assertStatus(200);
    }
}
