<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DependecyInjectionTest extends TestCase
{
    public function testDependecyInjection() {
        $foo = new Foo();
        $bar = new Bar($foo);

        // $bar->setFoo($foo);
        // $bar->foo = $foo;

        $this->assertEquals('Foo and Bar', $bar->bar());
    }

}
