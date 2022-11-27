<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        // $foo = new Foo();
        $foo1 = $this->app->make(Foo::class); // new foo()
        $foo2 = $this->app->make(Foo::class); // new foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Wahyu", "Pambudi");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Wahyu', $person1->firstName); // closure() // new Person("Wahyu", "Pambudi");
        self::assertEquals('Pambudi', $person2->lastName);  // closure() // new Person("Wahyu", "Pambudi");
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Wahyu", "Pambudi");
        });

        $person1 = $this->app->make(Person::class);  // new Person("Wahyu", "Pambudi");
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals('Wahyu', $person1->firstName);
        self::assertEquals('Pambudi', $person2->lastName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Wahyu", "Pambudi");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);  // $person
        $person2 = $this->app->make(Person::class); //

        self::assertEquals('Wahyu', $person1->firstName);
        self::assertEquals('Pambudi', $person2->lastName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {

        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }


    public function testDependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app) {
            $foo = $app->make(Foo::class);
            return new Bar( $foo );
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        // kalau pakai closure
        $this->app->singleton(HelloService::class, function($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Wahyu', $helloService->hello('Wahyu'));
    }
}
