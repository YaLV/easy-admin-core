<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class vatControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testIndexAdd()
     {
       $this->actingAs(\App\User::find(1));
       $response = $this->call('GET', route('vat'));
       $response->assertStatus(200);

       $response = $this->call('GET', route('vat.add'));
       $response->assertStatus(200);

     }

     public function testCreateEditVat(){

       $this->actingAs(\App\User::find(1));
       $faker = \Faker\Factory::create('en_US');

       foreach(languages() as $language) {
         $name = $faker->Name();
         $save['name'] = $name;
         $save['amount'] = rand(1, 10);
       }

       $response = $this->post(route('vat.store'), $save);
       $response->assertStatus(302);
       $response->assertRedirect(route('vat'));

       $vat = \App\Plugins\Vat\Model\Vat::where(['name' => $save['name'], 'amount' => $save['amount']])->first();

       $response = $this->call('GET', route('vat.edit', $vat->id));
       $response->assertStatus(200);

       $response = $this->json('POST', route('vat.destroy', $vat->id));
       $response->assertStatus(200);

     }
}
