<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServicesTest extends TestCase
{
   private UserServices $userServices;

   protected function setUp():void {
      parent::setUp();

      $this->userServices = $this->app->make(UserServices::class);
   }
   
   // public function testSample()
   // {
   //    self::assertTrue(true);
   // }

   // unit test login
   public function testLoginSuccess()
   {
      self::assertTrue($this->userServices->login("wahyu", "rahasia"));
   }

   public function testLoginUserNotFound()
   {
      self::assertFalse($this->userServices->login("udin", "udin"));
   }

   public function testLoginWrongPassword()
   {
      self::assertFalse($this->userServices->login("wahyu", "wahyu"));
   }
}
