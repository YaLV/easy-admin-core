<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Plugins\Products\Model\Product;
use App\Plugins\Products\Model\ProductVariation;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class productControllerTest extends TestCase
{
    // use DatabaseTransactions;
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
      $response->assertSee("Description");


    }

    public function testCreateEditProducts(){

      $this->actingAs(\App\User::find(1));
      $faker = \Faker\Factory::create('en_US');


      foreach(languages() as $language){
        $sku = $faker->Name();
        $save['sku'] = $sku;
        $save['main_category'] = 1;
        $save['supplier_id'] = 1;
        $save['vat_id'] = 1;
        $save['unit_id'] = 1;
        $save['cost'] = 1;
        $save['mark_up'] = 1;

      }

      $response = $this->post(route('products.store'), $save);
      $response->assertStatus(302);
      // $response->assertRedirect(route('products.list'));

      $product = Product::create(['sku' => $save['sku'], 'main_category' => $save['main_category'], 'supplier_id' => $save['supplier_id'], 'vat_id' => $save['vat_id'], 'unit_id' => $save['unit_id'], 'cost' => $save['cost'], 'mark_up' => $save['mark_up']]);

      $response = $this->call('GET', route('products.edit', $product->id));
      $response->assertStatus(200);

      $response = $this->call('POST', route('products.destroy', $product->id));
      $response->assertStatus(200);

      /* TEST state() function*/
      $response = $this->call('POST', route('products.state', $product->id));
      $response->assertStatus(404);

      /* TEST calculatePrice() funciton*/
      $response = $this->call('POST', route('products.calc', ['vat_id' => $save['vat_id'], 'cost' => $save['cost']]));
      $response->assertStatus(200);

      /* TEST makeDisplayString() function*/
      $response = $this->call('POST', route('products.makedisplay', ['unit_id' => $save['unit_id'], 'amount' => 8]));
      $response->assertStatus(200);

      /* TEST productVariationStore() function*/

      foreach(languages() as $language){
        $varSave['product_id'] = $product->id;
        $varSave['amount'] = 2.23;
        $varSave['display_name'] = 'farmer';
      }

      $response = $this->post(route('products.variations.store'), $varSave);
      $response->assertStatus(200);

      $variation = ProductVariation::where('product_id', $varSave['product_id'])->first();

      $response = $this->call('POST', route('products.variations.load', $variation->id));
      $response->assertStatus(302);



      /* TEST product() relation*/
      //
      // $prod = $product->product();
      //
      // $response->assertEquals($prod->id, $product->id);




      // $variation = \App\Plugins\Products\Model\ProductVariation::create(['product_id' => $varSave['product_id'], 'amount' => $varSave['amount'], 'display_name' => $varSave['display_name']]);
      // dd($variation->id);
      //
      // $response = $this->call('POST', route('products.attributes.load', $variation->id));
      // $response->assertStatus(302);
    }
}
