<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class productControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
      $this->actingAs(\App\User::find(1));
      $response = $this->call('GET', route('products.list'));
      $response->assertStatus(200);
      $response->assertSee("Product Slug");

    }

    public function testCreateEditCategory(){

      $this->actingAs(\App\User::find(1));
      $faker = \Faker\Factory::create('en_US');
    }
}
