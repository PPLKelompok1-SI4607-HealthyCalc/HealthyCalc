<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteFoodLogTest extends DuskTestCase
{
    /**
     * Test menghapus data riwayat konsumsi gizi.
     * @group deletefood
     */
    public function testDeleteFoodLog()
    {
        $this->browse(function (Browser $browser) {
            // Login terlebih dahulu
            $browser->visit('/login')
                ->type('email', 'testuser@example.com') // Isi email
                ->type('password', 'password123') // Isi password
                ->press('Login') // Klik tombol login
                ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard

                // Kunjungi halaman riwayat konsumsi gizi
                ->visit('/riwayat-konsumsi-gizi')
                ->assertSee('Nasi Kuning') // Pastikan data "Nasi Kuning" terlihat
                ->clickLink('Hapus') // Klik tombol hapus berdasarkan teks "Hapus"
                ->waitForDialog(5) // Tunggu dialog konfirmasi muncul
                ->acceptDialog() // Klik tombol "OK" pada dialog konfirmasi
                ->waitUntilMissing('.swal2-container')
                ->assertDontSee('Nasi Kuning'); // Pastikan data "Nasi Kuning" tidak lagi terlihat
        });
    }
}
