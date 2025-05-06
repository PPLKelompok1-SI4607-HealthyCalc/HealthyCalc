<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginFailTest extends DuskTestCase
{
    /**
     * Test login dengan email atau password yang salah.
     * @group loginfail
     */
    public function testLoginWithInvalidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login') // Akses halaman login
                ->type('email', 'wronguser@example.com') // Isi email yang salah
                ->type('password', 'wrongpassword') // Isi password yang salah
                ->press('Login') // Klik tombol login
                ->assertPathIs('/login') // Pastikan tetap di halaman login
                ->assertSee('Email atau password salah'); // Pastikan pesan error terlihat
        });
    }
}
