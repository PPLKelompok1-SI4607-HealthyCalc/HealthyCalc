<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

class ViewEmptyRecipesListTest extends DuskTestCase
{
    /**
     * Test melihat daftar resep saat kosong
     *
     * @return void
     */
    public function testViewEmptyRecipesList()
    {
        // Simpan jumlah resep awal
        $initialRecipeCount = Recipe::count();
        
        // Jangan gunakan DatabaseMigrations atau truncate yang bisa menghapus data permanen
        
        // Gunakan lingkup transaksi database agar perubahan bisa di-rollback
        DB::beginTransaction();
        
        try {
            // Simpan ID semua resep yang ada untuk digunakan nanti
            $recipeIds = Recipe::pluck('id')->toArray();
            
            // Sembunyikan sementara semua resep (tidak menghapus)
            Recipe::whereIn('id', $recipeIds)->update(['nama_resep' => 'TEMPORARY_HIDDEN_FOR_TEST']);
            
            // Jalankan test
            $this->browse(function (Browser $browser) {
                $browser->visit('/recipes')
                        ->assertSee('Manajemen Resep Makanan Sehat')
                        ->assertSee('Belum ada resep yang ditambahkan')
                        ->screenshot('view_empty_recipes_list');
            });
        } finally {
            // Rollback semua perubahan database, mengembalikan ke kondisi awal
            DB::rollBack();
            
            // Verifikasi data tidak terhapus
            $this->assertEquals($initialRecipeCount, Recipe::count());
        }
    }
}