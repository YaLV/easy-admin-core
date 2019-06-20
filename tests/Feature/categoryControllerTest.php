<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Plugins\Categories;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use App\Plugins\Categories\Model\Category;
use Illuminate\Http\UploadedFile;
use App\Plugins\Categories\Model\CategoryMeta;
use App\Plugins\Attributes\Model\AttributeValue;
use App\Plugins\Attributes\Model\Attribute;
use App\Plugins\Products\Model\Product;



class categoryControllerTest extends TestCase
{
    use \App\Plugins\Categories\Functions\Category;
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @test
     */
     public function testIndex(){
       $this->actingAs(\App\User::find(1));
       $response = $this->call('GET', route('categories.list'));
       $response->assertStatus(200);
       $response->assertSee("Category Slug");

     }

     public function testAdd(){
       $response = $this->call('GET', route('categories.add'))->assertStatus(302);

     }

     public function testCreateEditCategory(){

       $this->actingAs(\App\User::find(1));
       $faker = \Faker\Factory::create('en_US');

       foreach(languages() as $language) {
         $name = $faker->Name();
         $save['name'][$language->code] = $name;
         $save['slug'][$language->code] = str_slug($name);
         if($language->code == language()) {
           $slug = str_slug($name);
         }
       }



       $response = $this->post(route('categories.store'), $save);

       $response->assertStatus(302);
       $response->assertRedirect(route('categories.list'));

       $response = $this->from(route('categories.add'))->post(route('categories.store'), $save);
       $response->assertStatus(302);
       $response->assertSessionHasErrors();

       $cid = \App\Plugins\Categories\Model\CategoryMeta::where(['meta_name' => 'slug', 'meta_value' => $slug, 'language' => language()])->first();

       $response = $this->call('GET', route('categories.edit', $cid->owner_id));
       $response->assertStatus(200);

       $save['id'] = $cid->owner_id;
       $response = $this->from(route('categories.edit', [$cid->owner_id]))->post(route('categories.store', [$cid->owner_id]), $save);
       $response->assertStatus(302);
       $response->assertRedirect(route('categories.list'));

       $save['image_main'][] = "asdasdasd";
       $save['image_id'][] = "1";

       // dd($save);
       $response = $this->from(route('categories.edit', ["shouldFail"]))->post(route('categories.store', ["shouldFail"]), $save);
       $response->assertStatus(302);
       $response->assertRedirect(route('categories.edit', ["shouldFail"]));
       $response->assertSessionHasErrors();

       // $save['main'][] = 33333;
       //
       // $response = $this->from(route('uploadFile', [$cid->owner_id]))->post(route('uploadFile', [$cid->owner_id], $save));
       // $response->assertStatus(200);
       // $response->assertRedirect(route('uploadFile', [$cid->owner_id]));
       $response = $this->json('POST', route('categories.destroy', $cid->owner_id));
       $response->assertStatus(200);

       // $response = $this->call('GET', route('categories.edit', $cid->owner_id));
       // $response->assertStatus(200);

       /*TEST parent() function*/

       $categoryMeta = CategoryMeta::create(['owner_id' => $cid->owner_id, 'meta_name' => 'test', 'meta_value' => 'value_test', 'language' => 'lv']);
       $category = Category::create(['parent_id' => $categoryMeta->id]);

       // dd($categoryMeta, $category);
       $parent = $category->parent();

       // dd($parent);

       $response->assertEquals($parent->parent_id, $categoryMeta->id);

     }


     public function testOpenAddCategory() {
       $this->actingAs(\App\User::find(1));
       $response = $this->get(route('categories.add'));
       $response->assertStatus(200);
       $response->assertSee('Display');
     }






}
