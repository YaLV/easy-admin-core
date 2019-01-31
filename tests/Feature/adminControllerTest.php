<?php

namespace Tests\Feature;

use App\Plugins\Admin\AdminController;
use App\Plugins\Admin\Model\File;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class adminControllerTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @test
     */
     public function testUnauthSlugify() {
       $faker = \Faker\Factory::create('en_US');
       $slug_str = $faker->realText(40);
       $result = $this->post(route('slugify'), ['slugify' => $slug_str]);
       $result->assertStatus(302);
     }

     public function testSlugify() {

       $this->actingAs(\App\User::find(1));

       $faker = \Faker\Factory::create('en_US');
       $slug_str = $faker->realText(40);
       $result = $this->post(route('slugify'), ['slugify' => $slug_str]);
       $result->assertStatus(200);
      $result->assertJson(['slug' => str_slug($slug_str)]);
     }

     public function testSuccessfulLogin() {
       $result = $this->followingRedirects()->post(route('login'), [
         'username' => 'admin',
         'password' => 'admin'
       ]);

       $result->assertStatus(200);
       $result->assertSee("Menu");
     }

     public function testFailedLogin() {
       $result = $this->from(route('login'))->post(route('login'), [
         'username' => 'admin',
         'password' => 'admisn'
       ]);

       $result->assertStatus(302);
       $result->assertRedirect(route('login'));
     }



}
