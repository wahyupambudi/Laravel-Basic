<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
        ->assertStatus(200)
        ->assertSeeText("hello response");
    }

    // ubah keterangan header
    public function testHeader()
    {
        $this->get('/response/header')
        ->assertStatus(200)
        ->assertSeeText("Wahyu")->assertSeeText("Budi")
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Author', 'Wahyu P')
        ->assertHeader('App', 'Belajar Laravel');
    }

    // response test view, file, download, json

    public function testView()
    {
        $this->get('/response/type/view')
        ->assertSeeText("hello wahyu");
    }

    public function testJson()
    {
        $this->get('/response/type/json')
        ->assertJson(['firstName' => "Wahyu", 'lastName' => "Budi"]);
    }

    // download / file

    public function testFile()
    {
        $this->get('/response/type/file')
        ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
        ->assertDownload('vlan.png');
    }

}
