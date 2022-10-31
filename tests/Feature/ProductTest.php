<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_products_in_admin_db()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_create_product(){

        Storage::fake('images');
        // $this->withoutExceptionHandling();
        $user = User::factory()->create()->make(['userType'=>false]);

        $headers = [ "Content-Type" =>"multipart/form-data" ];


        $response = $this->actingAs($user)
                ->json('POST','create/product',
                [Product::factory()->create()],$headers
        );
 
        $response
            ->assertStatus(200);
            // ->getStatusCode();
            // ->assertEquals(1,Prodcut::class);
    }

    public function test_delete_product()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create()->make(['userType'=>false]);
        $product = Product::factory()->create();
        $response = $this->actingAs($user)
                    ->get('/delete/product/'.$product->id);
        $response->assertStatus(200);
    }
}
