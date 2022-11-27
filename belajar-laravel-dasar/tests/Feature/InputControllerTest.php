<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get("/input/hello?name=Wahyu")->assertSeeText("Hello Wahyu");

        $this->post("/input/hello", ["name" => "Wahyu"])->assertSeeText("Hello Wahyu");
    }

    public function testNestedInput()
    {
        $this->post(
            "/input/hello/first",
            [
                "name" => [
                    "first" => "Wahyu",
                    "last" => "pambudi",
                ]
            ]
        )->assertSeeText("Hello Wahyu");
    }


    // test input all
    public function testInputAll()
    {
        $this->post(
            "/input/hello/input",
            [
                "name" => [
                    "first" => "Wahyu",
                    "last" => "pambudi",
                ]
            ]
        )->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Wahyu")
            ->assertSeeText("pambudi");
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                ['name' => 'Xiaomi 9C', 'price' => 400000],
                ['name' => 'Iphone 13', 'price' => 888888]
            ]
        ])->assertSeeText('Xiaomi 9C')->assertSeeText('Iphone 13');
    }

    // unit test input type
    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birthDate' => '2026-09-10'
        ])->assertSeeText('Budi')->assertSeeText('true')->assertSeeText('2026-09-10');
    }

    // unit test filter request input
    // assertDont supaya gak ambil name middle
    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Wahyu",
                "middle" => "Pambudi",
                "last" => "S.Kom"
            ]
        ])->assertSeeText("Wahyu")->assertSeeText("S.Kom")
        ->assertDontSeeText("Pambudi");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
                "username" => "Wahyu",
                "admin" => "true",
                "password" => "admin123"
        ])->assertSeeText("Wahyu")->assertSeeText("admin123")
        ->assertDontSeeText("true");
    }

    // filter merge
    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Wahyu",
            "password" => "admin123",
            "admin" => "true"
        ])->assertSeeText("Wahyu")->assertSeeText("admin123")
        ->assertSeeText("admin")->assertSeeText("false");
    }
}
