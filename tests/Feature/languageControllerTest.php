<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Languages;
use App\Plugins\Languages\LanguageController;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class languageControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @test
     */
    public function testAddAndIndex(){
      $this->actingAs(\App\User::find(1));
      $response = $this->call('GET', route('languages'));
      $response->assertStatus(200);
      $response->assertSee("Kods");

      $response = $this->call('GET', route('languages.add'));
      $response->assertStatus(200);
      $response->assertSee('Nosaukums');
    }

    /* Store, Edit & destroy */
    public function testCreateEditLanguage(){

      $this->actingAs(\App\User::find(1));
      $faker = \Faker\Factory::create('en_US');

      foreach(languages() as $language){
        $name = $faker->Name();
        $save['name'] = $name;
        $save['code'] = substr($name, 0, 2);
      }

      $response = $this->post(route('languages.store'), $save);
      $response->assertStatus(302);
      $response->assertRedirect(route('languages'));

      $lanid = Languages::where(['code' => $save['code'], 'name' => $save['name']])->first();

      $response = $this->call('GET', route('languages.edit', $lanid->id));
      $response->assertStatus(200);

      $response = $this->json('POST', route('languages.destroy', $lanid->id));
      $response->assertStatus(200);
    }

    public function testDefaultLanguage(){

      $this->actingAs(\App\User::find(1));
      $language = Languages::where('is_default', 1)->first();

      $lan = $this->setIsDefaultAttribute($language->id);

      $response->assertEquals($lan->id, $language->id);

    }

}
