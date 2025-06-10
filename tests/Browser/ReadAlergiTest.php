<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReadAlergiTest extends DuskTestCase
{
    /**
     * @group tabooview
     */
    public function testUserCanSeeTabooFoodList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard')
                ->visit('/taboo-foods')
                ->pause(1000)
                ->assertSee('ayam');
        });
    }
}