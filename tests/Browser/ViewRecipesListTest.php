<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ViewRecipesListTest extends DuskTestCase
{
    /**
     * Test melihat daftar resep saat ada data
     * @group resep
     */
    public function testViewRecipesListWithData(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/recipes')
                    ->assertSee('Manajemen Resep Makanan Sehat')
                    ->assertVisible('.grid') // Grid container resep (sesuaikan dengan class yang ada)
                    ->assertVisible('.bg-white.rounded-xl.shadow-md') // Card resep 
                    ->assertSee('Diet') // Memastikan tag nutrisi tampil
                    ->assertVisible('img') // Memastikan gambar tampil
                    ->assertVisible('a.text-blue-600') // Tombol edit
                    ->assertVisible('button.text-red-600'); // Tombol hapus
        });
    }
}