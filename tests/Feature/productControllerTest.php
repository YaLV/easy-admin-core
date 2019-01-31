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
     * @test
     */
    public function testExample()
    {
      $this->actingAs(\App\User::find(1));
      $response = $this->call('GET', route('products.list'));
      $response->assertStatus(200);
      $response->assertSee("Product Slug");

      $response = $this->call('GET', route('products.add'));
      $response->assertStatus(200);

    }

    public function testCreateEditProducts(){

      $this->actingAs(\App\User::find(1));
      $faker = \Faker\Factory::create('en_US');

      $cid = \App\Plugins\Categories\Model\CategoryMeta::where(['meta_name' => 'slug', 'meta_value' => $slug, 'language' => language()])->first();

      foreach(languages() as $language){
        $sku = $faker->Name();
        $save['sku'] = $sku;
        $save['main_category'] =

      }


      $response = $this->post(route('product.store'), $save);
      $response->assertStatus(302);
      $response->assertRedirect(route('product.list'));
    }
}
