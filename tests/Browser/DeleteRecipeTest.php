<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteRecipeTest extends DuskTestCase
{
    /**
     * Test menghapus resep dengan konfirmasi
     * @group resep
     */
    public function testDeleteRecipeWithConfirmation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/recipes')
                    ->assertSee('Manajemen Resep Makanan Sehat')
                    ->click('button.text-red-600') // Klik tombol hapus (ikon sampah)
                    ->acceptDialog() // Terima dialog konfirmasi JavaScript
                    ->assertPathIs('/recipes'); // Verifikasi tetap di halaman daftar resep
        });
    }

    /**
     * Test membatalkan penghapusan resep
     * @group resep
     */
    public function testCancelDeleteRecipe(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/recipes')
                    ->assertSee('Manajemen Resep Makanan Sehat')
                    ->click('button.text-red-600') // Klik tombol hapus (ikon sampah)
                    ->dismissDialog() // Tolak dialog konfirmasi JavaScript
                    ->assertPathIs('/recipes'); // Verifikasi tetap di halaman daftar resep
        });
    }
}