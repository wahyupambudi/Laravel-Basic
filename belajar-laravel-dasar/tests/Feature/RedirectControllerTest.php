<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    // unit test redirect route
    public function testRedirectName()
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/wahyu');
    }

    // unit test redirect action
    public function testRedirectAction()
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/name/wahyu');
    }

    // unit test redirect url
    public function testRedirectAway()
    {
        $this->get('/redirect/away')
            ->assertRedirect('https://www.google.com');
    }

}
