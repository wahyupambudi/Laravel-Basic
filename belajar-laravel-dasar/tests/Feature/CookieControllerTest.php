<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    // unit test membuat cookie
    public function testCreateCookie()
    {
        $this->get("/cookie/set")
            ->assertSeeText("Hello Cookie")
            ->assertCookie('User-Id', "wahyu")
            ->assertCookie('Is-Member', "true");
    }

    // unit test get cookie
    public function testGetCookie()
    {
        $this
            ->withCookie("User-Id", "wahyu")
            ->withCookie("Is-Member", "true")
            ->get('/cookie/get')
            ->assertJson([
                "userId" => "wahyu",
                "isMember" => "true"
            ]);
    }
}
