<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditProfileTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'dinar@gmail.com')
                ->type('password', 'dinar123')
                ->press('Login')
                ->assertPathIs('/dashboard')

                // Kunjungi halaman riwayat konsumsi gizi
                ->visit('/riwayat-konsumsi-gizi')
                ->assertSee('Batagor') // Pastikan data "Nasi" terlihat
                ->clickLink('Edit') // Klik tombol edit berdasarkan class
                ->assertPathContains('/riwayat-konsumsi-gizi') // Pastikan berada di halaman edit
                ->type('food_name', 'Nasi Kuning') // Ubah nama makanan
                ->type('calories', '400') // Ubah kalori
                ->press('Simpan Perubahan') // Klik tombol simpan
                ->waitUntilMissing('.swal2-container') // Tunggu hingga modal hilang
                ->assertSee('Nasi Kuning') // Pastikan data yang diubah terlihat
                ->assertSee('400'); // Pastikan kalori yang diubah terlihat
        });
    }
}
