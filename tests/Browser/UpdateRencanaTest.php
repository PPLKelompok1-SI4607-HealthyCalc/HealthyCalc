<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateRencanaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group rencana
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard')
                ->visit('/food-plannings/6')
                ->click('.bi.bi-trash')
                ->pause(5000)
                ->assertPathIs('/food-plannings');
        });
    }
}
