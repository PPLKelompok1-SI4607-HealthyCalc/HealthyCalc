<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group login
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login') // Akses halaman login
                ->type('email', 'testuser@example.com') // Isi email
                ->type('password', 'password123') // Isi password
                ->press('Login') // Klik tombol login
                ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard
                ->assertSee('Dashboard'); // Pastikan teks "Dashboard" terlihat
        });
    }
}
