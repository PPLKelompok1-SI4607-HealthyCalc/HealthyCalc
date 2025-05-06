<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class inputTest extends DuskTestCase
{
    /**
     * Test user can input data and submit the form.
     * @group input 
     */
    public function testUserCanInputData(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/kalori') // Ganti dengan URL halaman input data
                    ->assertSee('Data Pribadi') // Pastikan halaman memiliki teks ini
                    ->type('tinggi_badan', '170') // Isi tinggi badan
                    ->select('tingkat_aktivitas', 'sedang') // Pilih tingkat aktivitas
                    ->select('tujuan', 'jaga') // Pilih tujuan
                    ->press('Hitung'); // Klik tombol "Hitung"
        });
    }

    /**
     * Test user cannot submit without input.
     */
    public function testUserCannotSubmitWithoutInput(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/kalori') // Ganti dengan URL halaman input data
                    ->assertSee('Data Pribadi') // Pastikan halaman memiliki teks ini
                    ->press('Hitung') // Klik tombol "Hitung" tanpa mengisi data
                    ->assertSee('Field ini wajib diisi') // Pastikan pesan validasi muncul
                    ->assertPathIs('/kalori'); // Pastikan tetap di halaman input
        });
    }
}
