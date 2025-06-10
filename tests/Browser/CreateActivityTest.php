<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateActivityTest extends DuskTestCase
{
    /**
     * Test create activity.
     * @group buat
     */
    public function testCreateActivity(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->waitForLocation('/dashboard', 10)
                ->assertPathIs('/dashboard')
                ->visit('/activities')
                ->click('@create-activity-button')
                ->pause(5000)
                ->type('activity_name', 'Jogging')
                ->select('intensity_level', 'Rendah')
                ->type('calories_burned', '300')
                ->type('duration_minutes', '30')
                ->type('activity_date', date('Y-m-d'))
                ->press('Tambah');
        });
    }
}
