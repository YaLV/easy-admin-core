<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class unitControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @test
     */
     public function testIndexAdd()
     {
       $this->actingAs(\App\User::find(1));
       $response = $this->call('GET', route('unit'));
       $response->assertStatus(200);

       $response = $this->call('GET', route('unit.add'));
       $response->assertStatus(200);

     }

     public function testCreateEditUnit(){

       $this->actingAs(\App\User::find(1));
       $faker = \Faker\Factory::create('en_US');

       foreach(languages() as $language) {
         $name = $faker->Name();
         $save['name'] = $name;
         $save['unit'] = substr($name, 0, 2);
       }

       $response = $this->post(route('unit.store'), $save);
       $response->assertStatus(302);
       $response->assertRedirect(route('unit'));


       $unit = \App\Plugins\Units\Model\Unit::where(['name' => $save['name'], 'unit' => $save['unit']])->first();

       $response = $this->call('GET', route('unit.edit', $unit->id));
       $response->assertStatus(200);


       //Neparbauda vai Unit tiek jau izmantots, tada gadijuma nevar izdzest.
       $response = $this->call('POST', route('unit.destroy', $unit->id));
       $response->assertStatus(200);

     }
}
