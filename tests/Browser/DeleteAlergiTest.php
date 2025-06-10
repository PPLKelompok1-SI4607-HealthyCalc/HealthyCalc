<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteAlergiTest extends DuskTestCase
{
    /**
     * Test user can delete taboo food successfully.
     *
     * @group taboodelete
     * @return void
     */
    public function test_user_can_delete_taboo_food_successfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard')
                ->visit('/taboo-foods')
                ->waitForText('Daftar Makanan Pantangan', 5)
                ->assertSee('ayam')
                ->click('.bi.bi-trash');
        });
    }
}