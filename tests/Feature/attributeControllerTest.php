<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Plugins\Products\Model\Product;
use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Attributes\Model\AttributeValue;


class attributeControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testIndex(){

       $this->actingAs(\App\User::find(1));
       $response = $this->call('GET', route('attributes.list'));
       $response->assertStatus(200);

       $response = $this->call('GET', route('attributes.add'));
       $response->assertStatus(200);

     }

     public function testAttribute(){

        $this->actingAs(\App\User::find(1));
        $faker = \Faker\Factory::create('en_US');

        // $attribute = App\Plugins\Attributes\Model\Attribute::create([''])
        foreach(languages() as $language){
          $name = $faker->Name();
          $save['name'] = $name;
          $save['slug'] = str_slug($name, '_');
        }

        // dd($save);
        //Kaut kas nesaglabajas pareizi!!!
        $response = $this->post(route('attributes.store'), $save);
        $response->assertStatus(200);
        // $response->assertRedirect(route('attributes.list'));

        // $attribute = Attribute::create(['name' => $save['name'], 'slug' => $save['slug']]);
        // dd($attribute);

     }

     public function testAttributeValue(){
       $this->actingAs(\App\User::find(1));
       $faker = \Faker\Factory::create('en_Us');

       foreach(languages() as $language){
         $name = $faker->Name();
         $save['meta_name'] = $name;
         $save['slug'] = str_slug($name, '_');
       }


       $response = $this->post(route('attributes.value.store'), $save);
       $response->assertStatus(200);

     }

     // public function testDatabaseRelations(){
     //   $this->actingAs(\App\User::find(1));
     //   $faker = \Faker\Factory::create('en_Us');
     //
     //   /* TEST product() relation*/
     //
     //   $attribute = \App\Plugins\Attributes\Model\AttributeValue::crete([''])
     //
     //   $products = $product->products();
     //   dd($products);
     //   $response->assertEquals($products->id, $product->id);
     //
     //
     // }

}
