<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditRecipesTest extends DuskTestCase
{
    /**
     * Test untuk mengedit resep dengan sukses (mengubah langkah memasak)
     * @group resep
     */
    public function testEditRecipeSuccess(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/recipes') // Kunjungi halaman daftar resep
                    ->assertSee('Manajemen Resep Makanan Sehat') // Pastikan halaman utama terlihat
                    ->click('a.text-blue-600') // Klik ikon pensil untuk edit
                    ->assertSee('Edit Resep') // Pastikan halaman edit terlihat
                    
                    // Buat perubahan pada langkah memasak
                    ->type('instructions', 'Langkah 1: Panaskan wajan. Langkah 2: Masukkan bumbu. Langkah 3: Masak hingga matang. Langkah 4: Sajikan.')
                    
                    // Klik tombol Perbarui Resep untuk menyimpan
                    ->press('Perbarui Resep')
                    
                    // Verifikasi diarahkan kembali ke halaman daftar resep
                    ->assertPathIs('/recipes');
        });
    }
}