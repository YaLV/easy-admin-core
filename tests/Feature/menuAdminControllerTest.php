<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Plugins\Menu\Model\FrontendMenu;
use App\Plugins\Menu\Model\FrontendMenuItem;
use Illuminate\Validation\Validator;

class menuAdminControllerTest extends TestCase
{
    // use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
      $this->actingAs(\App\User::find(1));
      $response = $this->call('GET', route('menus.list'));
      $response->assertStatus(200);

      $response = $this->call('GET', route('menus.add'));
      $response->assertStatus(200);
    }


    public function testMenu(){

      $this->actingAs(\App\User::find(1));
      $faker = \Faker\Factory::create('en_US');
      foreach(languages() as $language) {
        $name = $faker->Name();
        $save['name'] = $name;
        $save['slug'] = str_slug($name, '_');
        $save['protected'] = rand(0,1);
      }

      $response = $this->post(route('menus.store'), $save);
      $response->assertStatus(302);
      // $response->assertRedirect(route('menus.list'));

      $menug = FrontendMenu::where('name', $name)->first();

      $response = $this->call('GET', route('menus.edit', $menug->id));
      $response->assertStatus(200);

      /*TEST frontend_menus_item*/
      foreach(languages() as $language) {
        $name = $faker->Name();
        $saveitem['frontend_menu_id'] = $menug->id;
        $saveitem['menu_owner'] = $name;
        $saveitem['owner_id'] = 1;
        $saveitem['sequence'] = 0;
        // $saveitem['frontend_menu_item_id'] = 2;
      }

      $response = $this->post(route('menus.store.item', $saveitem));
      $response->assertStatus(302);

      $item = FrontendMenuItem::create(['frontend_menu_id' => $saveitem['frontend_menu_id'], 'menu_owner' => $saveitem['menu_owner'], 'owner_id' => $saveitem['owner_id'], 'sequence' => $saveitem['sequence']]);

      $response = $this->json('POST', route('menus.destroy.item', $item->id));
      $response->assertStatus(200);

      

    }


}
