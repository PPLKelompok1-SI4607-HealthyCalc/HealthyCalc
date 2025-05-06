<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewFoodLogEmptyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group datakosong
     */
    public function testExample(): void
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
                ->assertSee('Belum ada data makanan untuk periode ini.'); // Pastikan pesan kosong terlihat
        });
    }
}
