<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateAlergiTest extends DuskTestCase
{
    /**
     * @group taboocreate
     */
    public function testUserCanAddTabooFoodSuccessfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'testuser@example.com')      // Ganti dengan user login kamu
                ->type('password', 'testing123')          // Ganti juga password-nya
                ->press('Sign In')
                ->assertsee('Dashboard')
                ->pause(1000)
                ->visit('/taboo-foods')
                ->pause(1000)
                ->click('@create-taboo-food-button');

            $browser->pause(1000) 
                ->select('taboo', 'alergi')
                ->type('food_name', 'Udang')
                ->press('Tambah')
                ->pause(2000) 
                ->assertSee('Udang');
        });
    }
}