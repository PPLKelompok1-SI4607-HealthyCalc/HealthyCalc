<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class AccessAfterLogoutTest extends DuskTestCase
{
    /**
     * Test akses halaman dashboard setelah logout.
     * @group access
     */
    public function testAccessDashboardAfterLogout()
    {
        $this->browse(function (Browser $browser) {
            // Login
            $browser->visit('/login') // Akses halaman login
                ->type('email', 'testuser@example.com') // Isi email
                ->type('password', 'password123') // Isi password
                ->press('Login') // Klik tombol login
                ->waitUntilMissing('.swal2-container') // Tunggu hingga modal SweetAlert2 menghilang
                ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard
                ->press('Logout') // Klik tombol logout
                ->waitUntilMissing('.swal2-container'); // Tunggu hingga modal SweetAlert2 menghilang
                
        });
    }
}
