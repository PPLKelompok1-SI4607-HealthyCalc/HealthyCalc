<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistFailTest extends DuskTestCase
{
    /**
     * Test registrasi tanpa mengisi semua field wajib.
     * @group register
     */
    public function testRegistrationWithEmptyFields()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register') // Akses halaman registrasi
                ->press('Daftar') // Klik tombol registrasi tanpa mengisi field
                ->assertPathIs('/register') // Pastikan tetap di halaman registrasi
                ->assertSee('Please fill out this'); // Pastikan pesan error untuk nama terlihat
        });
    }
}
