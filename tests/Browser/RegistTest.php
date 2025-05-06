<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class RegistTest extends DuskTestCase
{
    /**
     * Test registrasi dengan kredensial yang valid.
     * @group regis
     */
    public function testRegistrationWithValidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register') // Akses halaman registrasi
                ->type('name', 'Test User') // Isi nama pengguna
                ->type('email', 'testuser@example.com') // Isi email
                ->type('username', 'testuser') // Isi username
                ->type('password', 'password123') // Isi password
                ->type('password_confirmation', 'password123') // Konfirmasi password
                ->press('Daftar') // Klik tombol registrasi
                ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard
                ->assertSee('Dashboard'); // Pastikan teks "Dashboard" terlihat
        });
    }
}
