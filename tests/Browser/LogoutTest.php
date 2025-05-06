<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LogoutTest extends DuskTestCase
{
    /**
     * Test logout setelah login berhasil.
     * @group logout
     */
    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            // Buat pengguna baru untuk pengujian
            $browser->visit('/login') // Akses halaman login
                ->type('email', 'testuser@example.com') // Isi email
                ->type('password', 'password123') // Isi password
                ->press('Login') // Klik tombol login
                ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard
                ->waitUntilMissing('.swal2-container') // Tunggu hingga modal SweetAlert2 menghilang
                ->press('Logout') // Klik tombol logout
                ->assertPathIs('/login'); // Pastikan diarahkan ke halaman login
        });
    }
}
