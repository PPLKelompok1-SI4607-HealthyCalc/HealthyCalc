<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;

class ViewFoodPlanningTest extends DuskTestCase
{
    /**
     * @group viewplanningfood
     */
    public function testUserCanViewFoodPlanning()
    {
        $user = User::where('email', 'tepi2@gmail.com')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', '12345678')
                ->press('Sign In')
                ->waitForLocation('/dashboard', 10)
                ->assertSee('Dashboard')

                ->visit('/food-plannings')
                ->pause(1000) // beri waktu DOM siap

                ->assertSee('ayam');
        });
    }
}
