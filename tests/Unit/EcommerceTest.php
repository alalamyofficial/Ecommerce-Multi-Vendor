<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EcommerceTest extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     */
    public function EcommerceTest()
    {
         $this->assertStatus(200);
    }
}
