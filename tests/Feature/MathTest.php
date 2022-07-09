<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MathTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_return_negative_one_when_given_negative_value()
    {
        $this->post(route('counter'), [
            'p1_aod' => -1,
            'p1_yod' => 1,
            'p2_aod' => 1,
            'p2_yod' => 1,
        ])->assertRedirect(route('home'))
        ->assertSessionHas('result', -1);
    }

    public function test_error_when_given_not_numeric_value()
    {
        $this->post(route('counter'), [
            'p1_aod' => 'a',
            'p1_yod' => 'a',
            'p2_aod' => 'a',
            'p2_yod' => 'a',
        ])->assertSessionHasErrors(['p1_aod', 'p1_yod', 'p2_aod', 'p2_yod']);
    }

    public function test_error_when_form_is_null()
    {
        $this->post(route('counter'), [
            'p1_aod' => null,
            'p1_yod' => null,
            'p2_aod' => null,
            'p2_yod' => null,
        ])->assertSessionHasErrors(['p1_aod', 'p1_yod', 'p2_aod', 'p2_yod']);
    }

    public function test_result_of_killed_villager_function_is_valid()
    {
        /**
         * check when year is 5 it must give result 12, because :
         * On the 5th year she kills 1 + 1 + 2 + 3 + 5 = 12 villagers
         */
        $math = new \App\Helpers\Math([]);
        $result = $math->getKilledVillager(5);

        $this->assertSame(12, $result);
    }

    public function test_result_is_valid()
    {
        /**
         * Given:
         * Person A: Age of death = 10, Year of Death = 12
         * Person B: Age of death = 13, Year of Death = 17
         * Answer:
         * Person A born on Year = 12 – 10 = 2, number of people killed on year 2 is 2.
         * Person B born on Year = 17 – 13 = 4, number of people killed on year 4 is 7.
         * So the average is ( 7 + 2 )/2 = 4.5
         */
        $this->post(route('counter'), [
            'p1_aod' => 10,
            'p1_yod' => 12,
            'p2_aod' => 13,
            'p2_yod' => 17,
        ])->assertSessionHasNoErrors()
        ->assertSessionHas('result', 4.5)
        ->assertRedirect(route('home'));
    }
}
