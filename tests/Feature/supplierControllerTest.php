<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Plugins\Suppliers\Model\Supplier;
class supplierControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSupplierIndex()
    {
        $this->actingAs(\App\User::find(1));
        $response = $this->call('GET', route('suppliers.list'));
        $response->assertStatus(200);

        $response = $this->call('GET', route('suppliers.add'));
        $response->assertStatus(200);
    }

    public function testSupplier()
    {
        $this->actingAs(\App\User::find(1));
        $faker = \Faker\Factory::create('en_US');

        foreach(languages() as $language) {
          $email = $faker->unique()->email;
          $name = $faker->Name();
          $save['custom_id'] = 2;
          $save['email'] = $email;
          $save['location'] = 'Latvia';
          $save['coords'] = '10.142.3.E';
          $save['farmer'] = rand(0, 1);
          $save['craftsman'] = rand(0, 1);
          $save['featured'] = rand(0, 1);
        }


        $response = $this->post(route('suppliers.store'), $save);
        $response->assertStatus(302);
        // $response->assertRedirect(route('suppliers.list'));


        $supplier = Supplier::create(['custom_id' => 2, 'email' => $email, 'location' => 'Latvia', 'coords' => '10.142.3.E', 'farmer' => rand(0,1), 'craftsman' => rand(0,1), 'featured' => rand(0,1)]);
        // where nestrada, jo store nenostrada lidz galam?
        // $supplier = Supplier::where(['custom_id' => $save['custom_id'], 'email' => $save['email'], 'location' => $save['location'], 'coords' => $save['coords'], 'farmer' => $save['farmer'], 'craftsman' => $save['craftsman'], 'featured' => $save['featured']]);

        // $response = $this->from(route('suppliers.edit', $supplier->id))->post(route('suppliers.store', $supplier->id), $save);
        // $response->assertStatus(302);

        $response = $this->call('GET', route('suppliers.edit', $supplier->id));
        $response->assertStatus(200);

        $response = $this->json('POST', route('suppliers.destroy', $supplier->id));
        $response->assertStatus(200);
    }

}
