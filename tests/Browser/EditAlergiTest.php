<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;

class EditAlergiTest extends DuskTestCase
{
    /**
     * Test user can update taboo food successfully.
     *
     * @group tabooupdate
     * @return void
     */
    public function testUserCanUpdateTabooFoodSuccessfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('Sign In')
                ->assertSee('Dashboard')
                ->pause(1000)
                ->visit('/taboo-foods')
                ->assertSee('Daftar Makanan Pantangan')
                ->press('@edit-taboo-food-button') // Pastikan ini selector tombol edit yang benar
                ->waitFor('.modal.show', 5)
                ->whenAvailable('.modal.show', function ($modal) {
                    $modal->clear('input[name="food_name"]')
                          ->type('input[name="food_name"]', 'Coklat')
                          ->select('select[name="taboo"]', 'kolesterol')
                          ->press('Ubah');
                })
                ->waitUntilMissing('.modal.show', 5);
        });
    }
}
