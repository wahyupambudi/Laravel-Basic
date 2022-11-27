<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class urlGenerationTest extends TestCase
{

    // get url full / current
    public function testUrlCurrent()
    {
        $this->get('/url/current?name=Wahyu')
            ->assertSeeText("/url/current?name=Wahyu");
    }

    // get url named
    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/wahyu');
    }

    // test url generation action
    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
