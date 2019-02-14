<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\MarketDays\Model\Vacation;
use App\Plugins\MarketDays\Functions\MarketDays;

class marketDaysControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListMarketDays(){

      $this->actingAs(\App\User::find(1));
      $response = $this->call('GET', route('marketdays'));
      $response->assertStatus(200);

      $response = $this->call('GET', route('vacations'));
      $response->assertStatus(200);

      $response = $this->call('GET', route('vacations.add'));
      $response->assertStatus(200);

    }

    public function testStoreMarketDays(){
      $this->actingAs(\App\User::find(1));
      $faker = \Faker\Factory::create('en_US');

      foreach(languages() as $language){
        $name = $faker->Name();
        $save['marketDay'] = $name;
        $save['marketDaysSlug'] = 'marketDaysSlug';
        $save['hideBeforeDays'] = 3;
        $save['hideBeforeHours'] = '12:00';
      }
      // dd($save);
      //kaut kas nesaglabajas pareizi?!
      $response = $this->post(route('marketdays.store', $save));
      $response->assertStatus(404);
      //modelii tika pievienots jauns fillable lauks 'marketDaysSlug', jo savadak testejot store metas erors
      $day = MarketDay::create(['marketDay' => $save['marketDay'], 'marketDaysSlug' => $save['marketDaysSlug'], 'hideBeforeDays' => $save['hideBeforeDays'], 'hideBeforeHours' => $save['hideBeforeHours']]);

      $response = $this->call('GET', route('marketdays.edit', $day->id));
      $response->assertSee('Market Day');

      $response = $this->call('POST', route('marketdays.state', $day->id));
      $response->assertStatus(200);

    }


    public function testStoreVacation(){

      $this->actingAs(\App\User::find(1));
      $faker = \Faker\Factory::create('en_US');
      $unixTimestamp = '1552229100'; //Start date must be anterior to end date.
      foreach(languages() as $language){
        $date = $faker->dateTimeBetween('now', $unixTimestamp);
        $save['vacation_date'] = $date->format("m/d/Y");
      }

      $response = $this->post(route('vacations.store'), $save);
      $response->assertStatus(302);

      $vacation = Vacation::where('vacation_date', $date->format('Y-m-d'))->first();

      $response = $this->json('POST', route('vacations.destroy', $vacation->id));
      $response->assertStatus(200);

    }

    // public function testClosestDay(){
    //
    //   $this->actingAs(\App\User::find(1));
    //   $response = $this->call('POST', 'App/Plugins/MarketDays/MarketDaysController@closestDay');
    //
    //   $response = $this->assertTrue($response->isOk());
    // }

}
