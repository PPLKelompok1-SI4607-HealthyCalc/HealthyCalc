<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;

class CreateFoodPlanningTest extends DuskTestCase
{
    /**
     * @group createplanningfood
     */
    public function testUserCanCreateFoodPlanning()
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
                ->click('.bg-success') // klik tombol <p> yang buka modal
                ->whenAvailable('#exampleModal', function (Browser $modal) {
                    $modal->select('food_category', 'Sarapan')
                        ->select('day', 'Senin')
                        ->type('title', 'ayam')
                        ->type('description', 'Makanan favorit pagi hari')
                        ->script([
                            "document.getElementById('planned_time').value = '07:00';"
                        ]);
                })
                ->press('Buat')
                ->pause(1000)
                ->assertPathIs('/food-plannings')
                ->waitForText('ayam', 10)
                ->assertSee('ayam');
        });
    }
}
