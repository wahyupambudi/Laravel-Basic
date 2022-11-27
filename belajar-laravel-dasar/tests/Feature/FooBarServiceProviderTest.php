<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);

        self::assertSame($foo1, $bar1->foo);
        self::assertSame($foo2, $bar2->foo);

    }

    public function testPropertySingletons()
    {
        $helloServices1 = $this->app->make(HelloService::class);
        $helloServices2 = $this->app->make(HelloService::class);

        self::assertSame($helloServices1, $helloServices2);

        self::assertEquals('Halo Wahyu', $helloServices1->hello('Wahyu'));
    }

    public function testEmpty()
    {
        self::assertTrue(true);
    }
}
