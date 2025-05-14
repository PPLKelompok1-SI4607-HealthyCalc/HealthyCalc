<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditRecipeCancelTest extends DuskTestCase
{
    /**
     * Test edit resep lalu klik tombol batal
     */
    public function testEditRecipeThenCancel()
    {
        // Pastikan ada setidaknya satu resep di database
        $recipe = Recipe::first();
        
        // Jika tidak ada resep, buat satu
        if (!$recipe) {
            $recipe = Recipe::create([
                'nama_resep' => 'Test Recipe Cancel',
                'kalori' => 300,
                'waktu_masak' => '30 min',
                'tag_nutrisi' => 'Diet'
            ]);
        }

        // Simpan nama resep asli untuk pemeriksaan nanti
        $originalName = $recipe->nama_resep;
        $newName = 'Changed Recipe Name - ' . time();

        $this->browse(function (Browser $browser) use ($recipe, $originalName, $newName) {
            $browser->visit('/recipes/' . $recipe->id . '/edit')
                    // Mengambil screenshot sebelum perubahan
                    ->screenshot('before_edit_cancel')
                    
                    // Mengubah data
                    ->type('name', $newName)
                    ->type('calories', 500)
                    
                    // Mengambil screenshot setelah perubahan
                    ->screenshot('after_edit_before_cancel')
                    
                    // Klik tombol Batal - pastikan ini sesuai dengan elemen di halaman Anda
                    ->click('.px-4.py-2.bg-gray-200')
                    
                    // Memastikan diarahkan ke halaman index
                    ->assertPathIs('/recipes')
                    
                    // Memastikan kembali ke halaman daftar resep
                    ->assertSee('Manajemen Resep Makanan Sehat') // Menggunakan teks yang ada di halaman
                    ->screenshot('after_cancel');
            
            // Memeriksa database untuk memastikan data tidak berubah
            $updatedRecipe = Recipe::find($recipe->id);
            $this->assertEquals($originalName, $updatedRecipe->nama_resep);
        });
    }
}