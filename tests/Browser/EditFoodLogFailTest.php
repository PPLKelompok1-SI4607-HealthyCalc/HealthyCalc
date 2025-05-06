<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditFoodLogFailTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group editfail
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'testuser@example.com') // Isi email
                ->type('password', 'password123') // Isi password
                ->press('Login') // Klik tombol login
                ->assertPathIs('/dashboard') // Pastikan diarahkan ke dashboard

                // Kunjungi halaman riwayat konsumsi gizi
                ->visit('/riwayat-konsumsi-gizi')
                ->assertSee('Nasi Kuning') // Pastikan data "Nasi Kuning" terlihat
                ->clickLink('Edit') // Klik tombol edit berdasarkan teks "Edit"
                ->assertPathContains('/riwayat-konsumsi-gizi') // Pastikan berada di halaman edit

                // Masukkan data tidak valid
                ->type('food_name', '') // Kosongkan nama makanan
                ->type('calories', '-100') // Masukkan nilai negatif untuk kalori
                ->press('Simpan Perubahan') // Klik tombol simpan
                ->waitUntilMissing('.swal2-container');
        });
    }
}
