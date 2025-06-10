<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditActivityTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group editactivity
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
                ->visit('/activities')
                ->click('editactivityModalLabel-2')
                ->pause(2000)
                ->type('activity_name', 'Jogging')
                ->press('.btn.btn-primary');
        });
    }
}
