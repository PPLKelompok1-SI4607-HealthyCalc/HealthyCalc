<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddRecipeWithoutNutritionTest extends DuskTestCase
{
    /**
     * Test menambahkan resep baru tanpa informasi gizi
     * @group resep
     */
    public function testAddRecipeWithoutNutrition(): void
    {
        $this->browse(function (Browser $browser) {
            // Buat nama resep unik untuk memudahkan verifikasi
            $recipeName = 'Resep Tanpa Gizi ' . rand(100, 999);
            
            $browser->visit('/recipes')
                    ->assertSee('Manajemen Resep Makanan Sehat')
                    ->clickLink('Tambah Resep')
                    ->assertPathIs('/recipes/create')
                    ->assertSee('Tambah Resep Baru')
                    
                    // Isi kolom wajib
                    ->type('name', $recipeName)
                    ->type('calories', '300')
                    ->type('time', '15 min')
                    ->select('tag', 'Diet')
                    ->type('ingredients', 'Bahan 1, Bahan 2, Bahan 3')
                    ->type('instructions', 'Langkah 1: Siapkan bahan. Langkah 2: Masak. Langkah 3: Sajikan.')
                    
                    // Sengaja mengosongkan kolom protein, carbs, dan fat
                    // Klik tombol simpan
                    ->press('Simpan Resep')
                    
                    // Verifikasi diarahkan ke halaman daftar resep
                    ->assertPathIs('/recipes')
                    
                    // Verifikasi resep berhasil disimpan
                    ->assertSee($recipeName);
        });
    }
}