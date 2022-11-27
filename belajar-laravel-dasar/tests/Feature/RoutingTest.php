<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/aw')
        ->assertStatus(200)
        ->assertSeeText("Hello Awonapa");
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText("Product 1");

        $this->get('/products/2')
            ->assertSeeText("Product 2");
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')->assertSeeText("Category 100");
        $this->get('/categories/udin')->assertSeeText("404 Awonapa");

    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/adam')->assertSeeText("User adam");
        $this->get('/users/')->assertSeeText("User 404");

    }

    public function testNameRouted()
    {
        $this->get('/produk/12345')->assertSeeText('Link http://localhost/products/12345');
    }
}
