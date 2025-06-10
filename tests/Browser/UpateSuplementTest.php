<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpateSuplementTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group update
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com')
                ->type('password', 'testing123')
                ->press('@login-button')
                ->assertPathIs('/dashboard')
                ->visit('/suplemens')
                ->click('.btn.btn-link.text-dark.p-0.m-0')
                ->click('.bi.bi-pencil-square.me-2')
                ->type('suplemen_name', 'Updated Suplemen')
                ->press('Batal')
                ->assertSee('Vitamin C');

        });
    }
}
