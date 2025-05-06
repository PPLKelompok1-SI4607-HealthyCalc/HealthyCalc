<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CancelDeleteFoodLogTest extends DuskTestCase
{
    /**
     * Test membatalkan penghapusan data riwayat konsumsi gizi.
     * @group canceldeletefood
     */
    public function testCancelDeleteFoodLog()
    {
        $this->browse(function (Browser $browser) {
            // Login terlebih dahulu
            $browser->visit('/login')
                ->type('email', 'testuser@example.com') // Isi email
                ->type('password', 'password123') // Isi password
                ->press('Login') // Klik tombol login
                ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard

                // Kunjungi halaman riwayat konsumsi gizi
                ->visit('/riwayat-konsumsi-gizi') // Kunjungi halaman riwayat konsumsi gizi
                ->assertSee('Bubur') // Pastikan data "Nasi Kuning" terlihat
                ->waitFor('button[data-id="3"]', 5) // Tunggu tombol hapus muncul
                ->click('button[data-id="3"]') // Klik tombol hapus
                ->waitForDialog(5) // Tunggu dialog konfirmasi muncul
                ->dismissDialog() // Klik tombol "Cancel" pada dialog konfirmasi
                ->pause(1000) // Tunggu sejenak untuk memastikan dialog tertutup
                ->assertSee('Bubur'); // Pastikan data "Nasi Kuning" masih terlihat
        });
    }
}
